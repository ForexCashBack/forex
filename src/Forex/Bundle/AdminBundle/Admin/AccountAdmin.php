<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Forex\Bundle\CoreBundle\Account\AccountManager;
use Forex\Bundle\CoreBundle\Entity\Account;
use Forex\Bundle\CoreBundle\Entity\Broker;
use Forex\Bundle\CoreBundle\Entity\User;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AccountAdmin extends Admin
{
    protected $accountManager;

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('accountNumber')
            ->add('status', 'choice', array(
                'choices' => array(
                    Account::STATUS_VERIFIED => 'Verified',
                    Account::STATUS_UNVERIFIED => 'Unverified',
                    Account::STATUS_INVALID => 'Invalid',
                ),
            ))
            ->add('broker', 'sonata_type_model', array(), array())
            ->add('user', 'sonata_type_model', array(), array())
            ->add('payoutPercentage', 'percent')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('user')
            ->add('status')
            ->add('broker')
            ->add('accountNumber')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('user')
            ->add('status')
            ->add('broker')
            ->add('accountNumber')
        ;
    }

    public function prePersist($account)
    {
        $this->getAccountManager()->createAccount($account);
    }

    public function setAccountManager(AccountManager $accountManager)
    {
        $this->accountManager = $accountManager;
    }

    public function getAccountManager()
    {
        return $this->accountManager;
    }
}
