<?php

namespace Forex\Bundle\EmailBundle\Email;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("forex.email_sender")
 */
class Sender
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

    public function sendToUser(User $user, $subjectLine, $templateName, array $data = array())
    {
        $this->sendToEmail($user->getEmail(), $subjectLine, $templateName, $data);
    }

    public function sendToEmail($email, $subjectLine, $templateName, array $data = array())
    {
        // Make the email being sent to available to the templates
        $data['to'] = $email;

        $html = $this->templating->render(sprintf('ForexEmailBundle:%s.html.twig', $templateName), $data);
        $text = $this->templating->render(sprintf('ForexEmailBundle:%s.text.twig', $templateName), $data);

        $from = array_key_exists('from', $data)
            ? $data['from']
            : array('jsuggs@forexcashback.com' => 'Forex Cash Back');

        $message = \Swift_Message::newInstance()
            ->setSubject($subjectLine)
            ->setFrom($from)
            ->setBody($html, 'text/html')
            ->addPart($text, 'text/plain')
            ->setTo($email)
        ;

        $status = $this->mailer->send($message);

        $this->logger->info(
            sprintf(
                'Email Message:: Email: %s Subject Line: %s Template: %s Data: %s',
                $email,
                $subjectLine,
                $templateName,
                json_encode($data)
            )
        );
    }
}
