<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BrokerAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('name')
                ->add('companyName')
                ->add('referralLink', 'url')
                ->add('minDeposit')
                ->add('maxLeverage')
                ->add('highlight')
                ->add('website')
                ->add('yearFounded')
                ->add('basePercentage', 'percent')
            ->end()
            ->with('Regulations')
                ->add(
                    'regulations',
                    'sonata_type_collection',
                    array(
                        'required' => false,
                        'by_reference' => false,
                    ),
                    array(
                        'edit' => 'inline'
                        ,'inline' => 'table',
                        'sortable' => 'id',
                    )
                )
            ->end()
            ->with('Images')
                ->add('rectangleImagePath')
                ->add('squareImagePath')
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('basePercentage', 'percent')
        ;
    }
}
