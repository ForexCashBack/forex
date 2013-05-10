<?php

namespace Forex\Bundle\WebBundle\Controller;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/account")
 */
class AccountController extends BaseController
{
    /**
     * @Route("/list", name="account_list")
     * @Template
     */
    public function listAction()
    {
        $user = $this->getUser();

        return array(
            'user' => $user,
        );
    }

    /**
     * @Route("/add", name="account_add")
     * @Template
     */
    public function addAction()
    {
        $user = $this->getUser();
        $brokers = $this->getRepository('ForexCoreBundle:Broker')->findAll();

        return array(
            'user' => $user,
            'brokers' => $brokers,
        );
    }

    /**
     * @Route("/create/{brokerId}", name="account_create")
     * @ParamConverter("broker", class="ForexCoreBundle:Broker", options={"id" = "brokerId"})
     * @Template
     */
    public function createAction(Broker $broker)
    {
        $user = $this->getUser();
        $form = $this->createAccountForm($user, $broker);

        return array(
            'user' => $user,
            'broker' => $broker,
            'form' => $form->createView(),
        );
    }
}
