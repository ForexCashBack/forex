<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Forex\Bundle\EmailBundle\Entity\EmailOpen;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EmailOpenAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', null, array('required' => false))
            ->add('message', 'sonata_type_model', array(), array())
            ->add('createdAt')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('message')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('message')
        ;
    }

    public function getNewInstance()
    {
        return new EmailOpen(new EmailMessage('', ''));
    }
}
