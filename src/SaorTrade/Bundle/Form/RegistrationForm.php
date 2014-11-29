<?php

namespace SaorTrade\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('email', 'text')
            ->add('password', 'repeated', array(
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'type'        => 'password'))
            ->add('submit', 'submit');
    }

    public function getName()
    {
        return 'registration';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'SaorTrade\Bundle\Entity\User',
            'validation_groups' => array('registration')
        );
    }
}