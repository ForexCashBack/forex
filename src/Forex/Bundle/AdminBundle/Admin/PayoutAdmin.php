<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PayoutAdmin extends Admin
{
    protected $payoutManager;

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', 'sonata_type_model', array(), array())
            ->add('amount', 'money', array(
                'currency' => 'USD',
                'divisor' => 100,
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('user')
            ->add('amount', 'money', array(
                'currency' => 'USD',
                'divisor' => 100,
            ))
        ;
    }

    public function postPersist($object)
    {
        $this->getPayoutManager()->resolvePartialPayouts($object);
        die('pst');
    }

    public function setPayoutManager($payoutManager)
    {
        $this->payoutManager = $payoutManager;
    }

    protected function getPayoutManager()
    {
        return $this->payoutManager;
    }
}
