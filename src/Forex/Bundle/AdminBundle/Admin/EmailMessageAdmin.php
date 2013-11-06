<?php

namespace Forex\Bundle\AdminBundle\Admin;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EmailMessageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Recipients')
                ->add('id', null, array('required' => false))
                ->add('email', 'email', array('required' => false))
                ->add('ccEmail', 'email', array('required' => false))
                ->add('bccEmail', 'email', array('required' => false))
                ->add('replyTo', 'email', array('required' => false))
                ->add('user', 'sonata_type_model', array('required' => false), array())
                ->add('status', 'choice', array(
                    'choices' => array(
                        EmailMessage::STATUS_PENDING => 'Pending',
                        EmailMessage::STATUS_SENT => 'Sent',
                        EmailMessage::STATUS_ERROR => 'Error',
                    ),
                ))
            ->end()
            ->with('Meta')
                ->add('subjectLine')
                ->add('template')
                ->add('jsonData', 'textarea')
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('user')
            ->add('template')
            ->add('status')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('user')
            ->add('email')
            ->add('status')
            ->add('template')
            ->add('opened', 'boolean')
            ->add('clicked', 'boolean')
        ;
    }

    public function getNewInstance()
    {
        return new EmailMessage('Subject Line', 'Template (ex. Test:test)');
    }
}
