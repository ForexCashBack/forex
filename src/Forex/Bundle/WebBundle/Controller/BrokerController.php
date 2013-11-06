<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\CoreController;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}/broker", defaults={"_locale" = "en"})
 */
class BrokerController extends CoreController
{
    /**
     * @Route("/list", name="broker_list")
     * @Template
     */
    public function listAction()
    {
        $brokers = $this->getRepository('ForexCoreBundle:Broker')->findActive();

        return array(
            'brokers' => $brokers,
        );
    }

    /**
     * @Route("/broker/{slug}", name="broker_view")
     * @ParamConverter("broker", class="ForexCoreBundle:Broker", options={"slug" = "slug"})
     * @Template
     */
    public function viewAction(Broker $broker)
    {
        $user = $this->getUser();

        return array(
            'user' => $user,
            'broker' => $broker,
        );
    }
}
