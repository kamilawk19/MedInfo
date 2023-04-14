<?php

namespace App\Form;

use App\Entity\Dialysis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


use App\Form\MedicinesType;

class DialysisType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Weight_Before', null,[
                'label' => 'Waga przed',
            ])
            ->add('Weight_After', null,[
                'label' => 'Waga po',
            ])
            ->add('Blood_Pressure_Before', null,[
                'label' => 'Ciśnienie przed',
            ])
            ->add('Blood_Pressure_After', null,[
                'label' => 'Ciśnienie po',
            ])
            ->add('Pressure_During', null,[
                'label' => 'Ciśnienie w trakcie',
            ])
            ->add('Ultrafiltration', null,[
                'label' => 'Ultrafiltracja',
            ])
            ->add('Glycemia', null,[
                'label' => 'Glikemia',
            ])
            ->add('Additional_Info', TextareaType::class,[
                'label' => 'Szczegóły',
            ])
            ->add('medicines', CollectionType::class, [
                'entry_type' => MedicinesType::class,
                'entry_options' => [
                    'label' => false,
                    //'data' => $options['medicines'] ?? null, // pass in the pre-populated medicines data
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__medicine_name__',
                'attr' => ['class' => 'medicines-collection'],
                'data_class' => null,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dialysis::class,
            'medicines' => null,
        ]);
    }
}
