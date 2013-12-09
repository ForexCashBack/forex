<?php

namespace Forex\Bundle\UserBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use FOS\UserBundle\Form\Type\RegistrationFormType as FOSFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @DI\FormType(alias="forex_user_registration")
 */
class RegistrationFormType extends FOSFormType
{
    public function __construct()
    {
        parent::__construct('Forex\Bundle\CoreBundle\Entity\User');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('language', 'language', array(
            'preferred_choices' => array(
                'en',
                'fr',
                'de',
                'es',
            ),
        ));
    }

    public function getName()
    {
        return 'forex_user_registration';
    }
}
