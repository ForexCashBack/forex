<?php

namespace Forex\Bundle\EmailBundle\Email;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("forex.email_sender")
 */
class Sender implements EmailSenderInterface
{
    protected $mailer;
    protected $templating;
    protected $logger;

    /**
     * @DI\InjectParams({
     *      "mailer" = @DI\Inject("mailer"),
     *      "templating" = @DI\Inject("templating"),
     *      "logger" = @DI\Inject("logger")
     * })
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->logger = $logger;
    }

    public function send(EmailMessage $message)
    {
        // Make the email being sent to available to the templates
        $data = array(
            '_to' => $message->getEmail(),
            '_message' => $message,
        );

        $html = $this->templating->render(sprintf('ForexEmailBundle:%s.html.twig', $message->getTemplate()), $data);
        $text = $this->templating->render(sprintf('ForexEmailBundle:%s.text.twig', $message->getTemplate()), $data);

        $from = array_key_exists('from', $data)
            ? $data['from']
            : array('system@forexcashback.com' => 'Forex Cash Back');

        $swiftMessage = \Swift_Message::newInstance()
            ->setSubject($message->getSubjectLine())
            ->setFrom($from)
            ->setBody($html, 'text/html')
            ->addPart($text, 'text/plain')
            ->setTo($message->getEmail())
        ;

        try {
            $status = $this->mailer->send($swiftMessage);
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
}
