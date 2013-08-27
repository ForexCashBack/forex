<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BrokerAdmin extends Admin
{
    protected $entityManager;

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('name')
                ->add('slug')
                ->add('companyName')
                ->add('referralLink', 'url')
                ->add('minDeposit')
                ->add('maxLeverage')
                ->add('highlight')
                ->add('website')
                ->add('yearFounded')
                ->add('rate')
                ->add('basePercentage', 'percent')
                ->add('spread')
                ->add('spreadLink', 'url')
                ->add('usClients')
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

    public function preUpdate($broker)
    {
        foreach ($broker->getRegulations() as $regulation) {
            $this->getEntityManager()->persist($regulation);
        }
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

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
