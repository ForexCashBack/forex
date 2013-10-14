<?php

namespace Forex\Bundle\EmailBundle\Twig\Extension;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * AppExtension
 *
 * @DI\Service("forex.email.twig.link")
 * @DI\Tag("twig.extension")
 */
class LinkExtension extends \Twig_Extension
{
    private $container;

    /**
     * @DI\InjectParams({
     *      "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'email_link' => new \Twig_Function_Method($this, 'createEmailLink'),
        );
    }

    public function createEmailLink($toUrl, EmailMessage $message)
    {
        $linkManager = $this->container->get('forex.email.link_manager');

        $link = $linkManager->createLink($toUrl, $message);
        return $linkManager->getLocalLink($link);
    }

    public function getName()
    {
        return 'forex.email.link';
    }
}
