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
     * @Route("/how-to-choose-a-broker", name="how-to-choose-a-broker", options={"sitemap" = true})
     * @Template
     */
    public function howToChooseABrokerAction()
    {
        return array();
    }
}
