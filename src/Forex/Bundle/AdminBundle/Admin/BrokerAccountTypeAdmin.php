<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BrokerAccountTypeAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'broker, rank',
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('name')
                ->add('broker')
                ->add('rate')
                ->add('minDeposit')
                ->add('maxLeverage')
                ->add('basePercentage', 'percent')
                ->add('rank')
            ->end()
            ->with('Execution Types')
                ->add(
                    'executionTypes',
                    'sonata_type_model',
                    array(
                        'expanded' => true,
                        'multiple' => true,
                        'by_reference' => false,
                    )
                )
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('broker')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('basePercentage', 'percent')
            ->add('broker')
            ->add('rank')
        ;
    }
}
