<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BrokerAdmin extends Admin
{
    protected $entityManager;
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'rank',
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('name')
                ->add('rank')
                ->add('slug')
                ->add('companyName')
                ->add('referralLink', 'url')
                ->add('highlight')
                ->add('website')
                ->add('yearFounded')
                ->add('rate')
                ->add('basePercentage', 'percent')
                ->add('spread')
                ->add('spreadLink', 'url')
                ->add('usClients', 'checkbox', array(
                    'required' => false,
                ))
                ->add('active', 'checkbox', array(
                    'required' => false,
                ))
            ->end()
            ->with('Account Types')
                ->add(
                    'accountTypes',
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
            ->with('Promotions')
                ->add(
                    'promotions',
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
        foreach ($broker->getPromotions() as $promotion) {
            $this->getEntityManager()->persist($promotion);
        }
        foreach ($broker->getAccountTypes() as $accountType) {
            $this->getEntityManager()->persist($accountType);
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
            ->add('rank')
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
