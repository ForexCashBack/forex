<?php

namespace Forex\Bundle\WebBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accountNumber', 'text')
        ;

        $broker = $options['broker'];

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($broker) {
                $form = $event->getForm();

                $formOptions = array(
                    'class' => 'ForexCoreBundle:BrokerAccountType',
                    'multiple' => false,
                    'expanded' => true,
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) use ($broker) {
                        return $er->createQueryBuilder('bat')
                            ->where('bat.broker = :broker')
                            ->setParameter('broker', $broker);
                    },
                );

                $form->add('brokerAccountType', 'entity', $formOptions);
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Forex\Bundle\CoreBundle\Entity\Account',
            'broker' => null,
        ));
    }

    public function getName()
    {
        return 'account';
    }
}
