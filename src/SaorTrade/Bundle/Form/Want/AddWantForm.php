<?php

namespace SaorTrade\Bundle\Form\Want;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddWantForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('description', 'text')
            ->add('submit', 'submit');
    }

    public function getName()
    {
        return 'add_want';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'SaorTrade\Bundle\Entity\Want'
        );
    }
}