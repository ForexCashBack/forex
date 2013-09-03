<?php

namespace Forex\Bundle\WebBundle\Controller\Account;

use Forex\Bundle\CoreBundle\Controller\BaseController;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/account/{_locale}/account", defaults={"_locale" = "en"})
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
     * @Route("/new/{brokerId}", name="account_new")
     * @ParamConverter("broker", class="ForexCoreBundle:Broker", options={"id" = "brokerId"})
     * @Template
     */
    public function newAction(Broker $broker)
    {
        $user = $this->getUser();
        $form = $this->createAccountForm($user, $broker);

        return array(
            'user' => $user,
            'broker' => $broker,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/create/{brokerId}", name="account_create")
     * @ParamConverter("broker", class="ForexCoreBundle:Broker", options={"id" = "brokerId"})
     * @Template("ForexWebBundle:Account:new.html.twig")
     */
    public function createAction(Broker $broker)
    {
        $user = $this->getUser();
        $form = $this->createAccountForm($user, $broker);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $account = $form->getData();
            $this->getAccountManager()->createAccount($account);
            $this->getEntityManager()->flush();

            return $this->redirect($this->generateUrl('account_list'));
        }

        return array(
            'user' => $user,
            'broker' => $broker,
            'form' => $form->createView(),
        );
    }
}
