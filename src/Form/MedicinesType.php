<?php

namespace App\Form;

use App\Entity\Medicines;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PharmacySupply;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class MedicinesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('Dose', null, array('label' => 'Dawka'),)
            ->add('Additional_Info', null, array('label' => 'Szczegóły'),)
            ->add('ID_Dialysis', HiddenType::class)
            /* ->add('FK_Medicine', PharmacySupplyType::class, array('label' => 'Lek','label_attr' => [
                'class' => 'checkbox-inline',
            ],)) */
            ->add('FK_Medicine', EntityType::class, [
                'class' => PharmacySupply::class,
                'choice_label' => 'name',
                'label' => 'Nazwa leku',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medicines::class,
        ]);
    }
}
