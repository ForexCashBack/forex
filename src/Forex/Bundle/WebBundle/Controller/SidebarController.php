<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SidebarController extends CoreController
{
    /**
     * @Route("/_internal/sidebar/broker-rates", name="_sidebar_broker_rates")
     * @Template("ForexWebBundle:Sidebar:broker-rates.html.twig")
     */
    public function brokerRatesAction()
    {
        $brokers = $this->getRepository('ForexCoreBundle:Broker')->findActive();

        return array(
            'brokers' => $brokers,
        );
    }
}
