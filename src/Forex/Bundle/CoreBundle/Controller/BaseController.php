<?php

namespace Forex\Bundle\CoreBundle\Controller;

use Forex\Bundle\CoreBundle\Entity\Account;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Forex\Bundle\CoreBundle\Entity\User;
use Forex\Bundle\WebBundle\Form\AccountFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function getEntityManager()
    {
        return $this->container->get('doctrine.orm.default_entity_manager');
    }

    protected function getRepository($class)
    {
        return $this->getEntityManager()->getRepository($class);
    }

    protected function addMessage($type, $message)
    {
        $this->get('session')->getFlashBag()->add($type, $message);
    }

    protected function createAccountForm(User $user, Broker $broker)
    {
        $account = new Account();
        $account->setUser($user);
        $account->setBroker($broker);

        return $this->createForm(new AccountFormType(), $account);
    }
}
