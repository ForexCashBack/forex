<?php

namespace Forex\Bundle\EmailBundle\Link;

use Doctrine\ORM\EntityManager;
use Forex\Bundle\EmailBundle\Entity\EmailLink;
use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("forex.email.link_manager")
 */
class LinkManager
{
    protected $em;
    protected $logger;
    protected $domain;
    protected $debug;

    /**
     * @DI\InjectParams({
     *      "em" = @DI\Inject("doctrine.orm.default_entity_manager"),
     *      "logger" = @DI\Inject("logger"),
     *      "router" = @DI\Inject("router"),
     *      "debug" = @DI\Inject("%kernel.debug%"),
     * })
     */
    public function __construct(EntityManager $em, LoggerInterface $logger, $router, $debug)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->router = $router;
        $this->debug = $debug;
    }

    public function createLink($toUrl, EmailMessage $message)
    {
        $link = new EmailLink($toUrl, $message);

        $this->em->persist($link);
        if (!$this->debug) {
            $this->em->flush($link);
        }

        $this->logger->debug(sprintf('LinkManager::createLink - %s', $toUrl));

        return $link;
    }

    public function getLocalLink(EmailLink $link)
    {
        return $this->router->generate('email_link', array(
            'id' => $link->getId()
        ), true);
    }
}
