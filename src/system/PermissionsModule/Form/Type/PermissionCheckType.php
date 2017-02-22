<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\PermissionsModule\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionCheckType extends AbstractType
{
    /**
* @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = $options['translator'];

        $builder
            ->add('user', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'label' => $translator->__('User name'),
                'required' => false
            ])
            ->add('component', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'label' => $translator->__('Component to check'),
                'data' => '.*'
            ])
            ->add('instance', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'label' => $translator->__('Instance to check'),
                'data' => '.*'
            ])
            ->add('level', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', [
                'label' => $translator->__('Permission level'),
                'choices' => array_flip($options['permissionLevels']),
                'choices_as_values' => true,
                'data' => ACCESS_READ
            ])
            ->add('check', 'Symfony\Component\Form\Extension\Core\Type\ButtonType', [
                'label' => $translator->__('Check permission'),
                'icon' => 'fa-check',
                'attr' => [
                    'class' => 'btn btn-default'
                ]
            ])
            ->add('reset', 'Symfony\Component\Form\Extension\Core\Type\ButtonType', [
                'label' => $translator->__('Reset'),
                'icon' => 'fa-times',
                'attr' => [
                    'class' => 'btn btn-danger'
                ]
            ])
        ;
    }

    /**
* @inheritDoc
     */
    public function getBlockPrefix()
    {
        return 'zikulapermissionsmodule_permissioncheck';
    }

    /**
* @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => ['id' => 'testpermform'],
            'translator' => null,
            'permissionLevels' => []
        ]);
    }
}
