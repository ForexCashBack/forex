<?php

namespace Forex\Bundle\EmailBundle\Email;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Forex\Bundle\MandrillBundle\Email\Sender as MandrillSender;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("forex.email_sender")
 */
class Sender implements EmailSenderInterface
{
    protected $sender;
    protected $templating;
    protected $logger;

    /**
     * @DI\InjectParams({
     *      "sender" = @DI\Inject("forex.mandrill.sender"),
     *      "templating" = @DI\Inject("templating"),
     *      "logger" = @DI\Inject("logger")
     * })
     */
    public function __construct(MandrillSender $sender, EngineInterface $templating, LoggerInterface $logger)
    {
        $this->sender = $sender;
        $this->templating = $templating;
        $this->logger = $logger;
    }

    public function send(EmailMessage $message)
    {
        $data = $this->serializeMessage($message);

        try {
            $this->sender->send($data);
            $message->setStatus(EmailMessage::STATUS_SENT);

            $this->logger->info(
                sprintf(
                    'Email Message:: Email: %s Subject Line: %s Template: %s Data: %s',
                    $message->getEmail(),
                    $message->getSubjectLine(),
                    $message->getTemplate(),
                    $message->getJsonData()
                )
            );
        } catch (\Exception $e) {
            $message->setStatus(EmailMessage::STATUS_ERROR);

            $this->logger->error(
                sprintf(
                    'Email Message:: Email: %s Subject Line: %s Template: %s Data: %s',
                    $message->getEmail(),
                    $message->getSubjectLine(),
                    $message->getTemplate(),
                    $message->getJsonData()
                )
            );
        }
    }

    public function serializeMessage(EmailMessage $message)
    {
        // Make the email being sent to available to the templates
        $data = array_merge($message->getData(), array(
            'to' => array(
                array(
                    'email' => $message->getEmail(),
                    'type' => 'to',
                ),
            ),
            'subject' => $message->getSubjectLine(),
            '_message_id' => $message->getId(),
            'headers' => array(),
        ));

        $data['html'] = $this->templating->render(sprintf('ForexEmailBundle:%s.html.twig', $message->getTemplate()), $data);
        $data['text'] = $this->templating->render(sprintf('ForexEmailBundle:%s.text.twig', $message->getTemplate()), $data);

        $data['from_email'] = array_key_exists('from', $data)
            ? $data['from']
            : 'system@forexcashback.com';

        if ($message->getReplyTo()) {
            $data['headers']['Reply-To'] = $message->getReplyTo();
        }

        if ($message->getCcEmail()) {
            $data['to'][] = array(
                'email' => $message->getCcEmail(),
                'type' => 'cc',
            );
        }

        if ($message->getBccEmail()) {
            $data['to'][] = array(
                'email' => $message->getBccEmail(),
                'type' => 'bcc',
            );
        }

        return $data;
    }
}
