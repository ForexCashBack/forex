<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}/about", defaults={"_locale" = "en"}, requirements={"_locale" = "en|fr"})
 */
class AboutController extends BaseController
{
    /**
     * @Route("/payment-methods", name="payment-methods", options={"sitemap" = true})
     * @Template("ForexWebBundle:About:payment-methods.html.twig")
     */
    public function paymentMethodsAction()
    {
        return array();
    }

    /**
     * @Route("/who-we-are", name="who-we-are", options={"sitemap" = true})
     * @Template("ForexWebBundle:About:who-we-are.html.twig")
     */
    public function whoWeAreAction()
    {
        return array();
    }

    /**
     * @Route("/how-to-choose-a-broker", name="how-to-choose-a-broker", options={"sitemap" = true})
     * @Template("ForexWebBundle:About:how-to-choose-a-broker.html.twig")
     */
    public function howToChooseABrokerAction()
    {
        return array();
    }
}
