<?php

namespace App\Form;

use App\Entity\Dialysis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dialysis::class,
        ]);
    }
}
