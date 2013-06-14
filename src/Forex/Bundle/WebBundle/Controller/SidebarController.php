<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SidebarController extends BaseController
{
    /**
     * @Route("/_internal/sidebar/broker-rates", name="_sidebar_broker_rates")
     * @Template("ForexWebBundle:Sidebar:broker-rates.html.twig")
     */
    public function paymentMethodsAction()
    {
        $brokers = $this->getRepository('ForexCoreBundle:Broker')->findAll();

        return array(
            'brokers' => $brokers,
        );
    }
}
