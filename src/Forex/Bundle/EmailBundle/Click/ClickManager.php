<?php

namespace Forex\Bundle\EmailBundle\Click;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\EmailBundle\Entity\EmailClick;
use Forex\Bundle\EmailBundle\Entity\EmailLink;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("forex.email.click_manager")
 */
class ClickManager
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

    public function registerClick(EmailLink $link)
    {
        $click = new EmailClick($link);
        $this->em->persist($click);

        return $click;
    }
}

