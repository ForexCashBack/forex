<?php

namespace Forex\Bundle\CoreBundle\Controller;

use Forex\Bundle\CoreBundle\Entity\Account;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Forex\Bundle\CoreBundle\Entity\BrokerSuggestion;
use Forex\Bundle\CoreBundle\Entity\Complaint;
use Forex\Bundle\CoreBundle\Entity\User;
use Forex\Bundle\WebBundle\Form\AccountFormType;
use Forex\Bundle\WebBundle\Form\BrokerSuggestionFormType;
use Forex\Bundle\WebBundle\Form\ComplaintFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function getLocale()
    {
        return $this->getRequest()->attributes->get('_locale');
    }

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

    protected function getTranslatedKey($key)
    {
        return $this->get('translator')->trans($key);
    }

    protected function createAccountForm(User $user, Broker $broker)
    {
        $account = new Account();
        $account->setUser($user);
        $account->setBroker($broker);

        return $this->createForm(new AccountFormType(), $account);
    }

    protected function createBrokerSuggestionForm(User $user = null)
    {
        $brokerSuggestion = new BrokerSuggestion();
        $brokerSuggestion->setUser($user);

        return $this->createForm(new BrokerSuggestionFormType(), $brokerSuggestion);
    }

    protected function createComplaintForm(User $user = null)
    {
        $complaint = new Complaint();
        $complaint->setUser($user);

        return $this->createForm(new ComplaintFormType(), $complaint);
    }

    protected function createContactForm()
    {
        $form = $this->createFormBuilder()
            ->add('name')
            ->add('email')
            ->add('message', 'textarea')
            ->getForm();

        return $form;
    }

    protected function getAccountManager()
    {
        return $this->container->get('forex.account_manager');
    }
}
