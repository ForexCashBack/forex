<?php

namespace Forex\Bundle\EmailBundle\Email;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Forex\Bundle\CoreBundle\Entity\User;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("forex.email_manager")
 */
class EmailManager
{
    protected $em;
    protected $logger;

    /**
     * @DI\InjectParams({
     *      "em" = @DI\Inject("doctrine.orm.default_entity_manager"),
     *      "logger" = @DI\Inject("logger"),
     * })
     */
    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function sendToUser(User $user, $subjectLine, $templateName, array $data = array())
    {
        $message = $this->createEmailMessage($subjectLine, $templateName, $data);
        $message->setUser($user);

        $this->persistMessage($message);
    }

    public function sendToEmail($email, $subjectLine, $templateName, array $data = array())
    {
        $message = $this->createEmailMessage($subjectLine, $templateName, $data);
        $message->setEmail($email);

        $this->persistMessage($message);
    }

    public function createEmailMessage($subjectLine, $templateName, array $data = array())
    {
        return new EmailMessage($subjectLine, $templateName, $data);
    }

    private function persistMessage(EmailMessage $message)
    {
        $this->logger->debug(sprintf('EmailMessage - Creating Message - %s %s', $message->getTemplate(), $message->getJsonData()));
        $this->em->persist($message);
    }
}
