<?php

namespace Forex\Bundle\AdminBundle\Admin;

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
            ->add('amount', null, array(
                'help' => 'Enter payments as integers.  Ex. $123.45 = 12345',
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('broker')
            ->add('amount')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('broker')
            ->add('account')
            ->add('amount')
        ;
    }
}
