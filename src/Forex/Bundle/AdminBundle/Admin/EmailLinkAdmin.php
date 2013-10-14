<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Forex\Bundle\EmailBundle\Entity\EmailLink;
use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EmailLinkAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'string')
            ->add('toUrl')
            ->add('message', 'sonata_type_model', array(), array())
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('toUrl')
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
        return new EmailLink('http://test.com', new EmailMessage('', ''));
    }
}
