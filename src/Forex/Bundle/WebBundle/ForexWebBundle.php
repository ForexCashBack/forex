<?php

namespace Forex\Bundle\WebBundle;

use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ForexWebBundle extends Bundle
{
    public function boot()
    {
        $router = $this->container->get('router');
        $em = $this->container->get('doctrine.orm.default_entity_manager');
        $event  = $this->container->get('event_dispatcher');

        //listen presta_sitemap.populate event
        $event->addListener(
            SitemapPopulateEvent::ON_SITEMAP_POPULATE,
            function(SitemapPopulateEvent $event) use ($router, $em) {
                $url = $router->generate('homepage', array(), true);

                $event->getGenerator()->addUrl(
                    new UrlConcrete(
                        $url,
                        new \DateTime(),
                        UrlConcrete::CHANGEFREQ_HOURLY,
                        1
                    ),
                    'default'
                );

                foreach ($em->getRepository('ForexCoreBundle:Broker')->findActive() as $broker) {
                    $event->getGenerator()->addUrl(
                        new UrlConcrete(
                            $router->generate('broker_view', array('slug' => $broker->getSlug()), true),
                            new \DateTime(),
                            UrlConcrete::CHANGEFREQ_DAILY,
                            1
                        ),
                        'default'
                    );
                }

                foreach ($em->getRepository('ForexCoreBundle:Promotion')->findAll() as $promotion) {
                    $event->getGenerator()->addUrl(
                        new UrlConcrete(
                            $router->generate('promotion_view', array('slug' => $promotion->getSlug()), true),
                            new \DateTime(),
                            UrlConcrete::CHANGEFREQ_DAILY,
                            1
                        ),
                        'default'
                    );
                }
        });
    }
}
