<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends BaseController
{
    /**
     * @Route("/")
     * @Template
     */
    public function homepageAction()
    {
        return array();
    }

    /**
     * @Route("/hello/{name}")
     * @Template
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/brokers", name="brokers")
     * @Template
     */
    public function brokerAction()
    {
        $brokers = $this->getRepository('ForexCoreBundle:Broker')->findAll();

        return array(
            'brokers' => $brokers,
        );
    }
}
