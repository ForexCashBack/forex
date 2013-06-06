<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Forex\Bundle\CoreBundle\Payment\PaymentManager;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PaymentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('broker', 'sonata_type_model', array(), array())
            ->add('account', 'sonata_type_model', array(), array())
            ->add('amount', 'money', array(
                'currency' => 'USD',
                'divisor' => 100,
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('broker')
            ->add('account')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('broker')
            ->add('account')
            ->add('amount', 'money', array(
                'currency' => 'USD',
                'divisor' => 100,
            ))
        ;
    }

    public function prePersist($object)
    {
        $this->getPaymentManager()->createPartialPayouts($object);
    }

    public function setPaymentManager(PaymentManager $paymentManager)
    {
        $this->paymentManager = $paymentManager;
    }

    protected function getPaymentManager()
    {
        return $this->paymentManager;
    }
}
