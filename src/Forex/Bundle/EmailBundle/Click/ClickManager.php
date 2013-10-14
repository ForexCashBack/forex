<?php

namespace Forex\Bundle\EmailBundle\Click;

use Forex\Bundle\EmailBundle\Entity\EmailLink;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("forex.email.click_manager")
 */
class ClickManager
{
    protected $em;

    /**
     * @DI\InjectParams({
     *      "em" = @DI\Inject("forex.email_sender"),
     *      "logger" = @DI\Inject("logger")
     * })
     */
    public function __construct($em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function registerClick(EmailLink $link)
    {
        $click = new EmailClick($link);
        $this->em->persist($click);
        $this->em->flush($click);

        return $click;
    }
}

