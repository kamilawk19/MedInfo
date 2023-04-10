<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Country', null, [
                'label' => 'Kraj',
            ])
            ->add('Voivodeship', null, [
                'label' => 'Województwo',
            ])
            ->add('City', null, [
                'label' => 'Miasto',
            ])
            ->add('ZIP_Code', null, [
                'label' => 'Kod pocztowy',
            ])
            ->add('Street', null, [
                'label' => 'Ulica',
            ])
            ->add('Building_Number', null, [
                'label' => 'Numer budynku',
            ])
            ->add('Apartment_Number', null, [
                'label' => 'Numer mieszkania',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
