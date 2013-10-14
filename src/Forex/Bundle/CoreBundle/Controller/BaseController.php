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
use Forex\Bundle\WebBundle\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

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

    protected function createAccountForm(User $user, Broker $broker, BrokerAccountType $brokerAccountType = null)
    {
        $account = new Account();
        $account->setUser($user);
        $account->setBroker($broker);

        if (!$brokerAccountType) {
            $brokerAccountType = $broker->getAccountTypes()->first();
        }
        $account->setBrokerAccountType($brokerAccountType);

        return $this->createForm(new AccountFormType(), $account, array(
            'broker' => $broker,
        ));
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
        $collectionContstraint = new Collection(array(
            'email' => new Email(),
            'name' => new NotBlank(),
            'message' => new NotBlank(),
        ));

        return $this->createForm(new ContactFormType(), null, array(
            'validation_constraint' => $collectionContstraint,
        ));
    }

    protected function getAccountManager()
    {
        return $this->container->get('forex.account_manager');
    }

    protected function getEmailManager()
    {
        return $this->container->get('forex.email_manager');
    }

    protected function getClickManager()
    {
        return $this->container->get('forex.email.click_manager');
    }
}
