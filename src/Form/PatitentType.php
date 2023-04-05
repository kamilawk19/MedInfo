<?php

namespace App\Form;

use App\Entity\Patitent;
use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class PatitentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('PESEL', null,[
                'label' => 'PESEL',
            ])
            ->add('Document_Number', null,[
                'label' => 'Numer dokumentu',
            ])
            ->add('Document_Name', null,[
                'label' => 'Nazwa dokumentu',
            ])
            ->add('First_Name', null,[
                'label' => 'Pierwsze imię',
            ])
            ->add('Second_Name', null,[
                'label' => 'Drugie imię',
            ])
            ->add('Last_Name', null,[
                'label' => 'Nazwisko',
            ])
            ->add('Sex', null,[
                'label' => 'Płeć',
            ])
            ->add('Dialing_Code', null,[
                'label' => 'Numer kierunkowy',
            ])
            ->add('Phone_Number', null,[
                'label' => 'Telefon',
            ])
            ->add('Contact_Dialing_Code', null,[
                'label' => 'Numer kierunkowy kontaktu',
            ])
            ->add('Contact_Phone_Number', null,[
                'label' => 'Numer telefonu kontaktu',
            ])
            ->add('Additional_info', null,[
                'label' => 'Szczegóły',
            ])
            //->add('ID_Address', HiddenType::class) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patitent::class,
        ]);
    }
}
