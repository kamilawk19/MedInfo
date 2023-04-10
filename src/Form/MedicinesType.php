<?php

namespace App\Form;

use App\Entity\Medicines;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicinesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Dose')
            ->add('Additional_Info')
            ->add('ID_Dialysis')
            ->add('FK_Medicine')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medicines::class,
        ]);
    }
}
