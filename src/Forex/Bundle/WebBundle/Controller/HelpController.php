<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}/help", defaults={"_locale" = "en"}, requirements={"_locale" = "en|fr"})
 */
class HelpController extends BaseController
{
    /**
     * @Route("/faq", name="faq", options={"sitemap" = true})
     * @Template
     */
    public function faqAction()
    {
        return array();
    }

    /**
     * @Route("/how-to-choose-a-broker", name="how-to-choose-a-broker", options={"sitemap" = true})
     * @Template
     */
    public function howToChooseABrokerAction()
    {
        return array();
    }

    /**
     * @Route("/residual-income", name="residual-income", options={"sitemap" = true})
     * @Template
     */
    public function residualIncomeAction()
    {
        return array();
    }

    /**
     * @Route("/earning-potential", name="earning-potential", options={"sitemap" = true})
     * @Template
     */
    public function earningPotentialAction()
    {
        return array();
    }
}
