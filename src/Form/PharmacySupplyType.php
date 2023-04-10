<?php

namespace App\Form;

use App\Entity\PharmacySupply;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PharmacySupplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', null, array('label' => 'Nazwa',))
            ->add('International_Name', null, array('label' => 'INN',))
            ->add('Description', null, array('label' => 'Opis',))
            ->add('Quantity', null, array('label' => 'Ilość',))
            ->add('Exp_Date', null, array('label' => 'Data ważności',))
            ->add('Drug_List_N', null, array('label' => 'Lista N','label_attr' => [
                'class' => 'checkbox-inline',
            ],))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PharmacySupply::class,
        ]);
    }
}
