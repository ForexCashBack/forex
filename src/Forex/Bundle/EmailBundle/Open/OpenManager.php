<?php

namespace Forex\Bundle\EmailBundle\Open;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Forex\Bundle\EmailBundle\Entity\EmailOpen;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("forex.email.open_manager")
 */
class OpenManager
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

    public function registerOpen(EmailMessage $message)
    {
        $open = new EmailOpen($message);
        $this->em->persist($open);

        return $open;
    }
}

