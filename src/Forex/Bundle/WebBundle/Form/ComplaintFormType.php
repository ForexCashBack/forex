<?php

namespace Forex\Bundle\WebBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComplaintFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('complaint', 'textarea')
            ->add('broker', 'entity', array(
                'class' => 'ForexCoreBundle:Broker',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.name', 'ASC');
                },
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Forex\Bundle\CoreBundle\Entity\Complaint',
        ));
    }

    public function getName()
    {
        return 'broker_complaint';
    }
}
