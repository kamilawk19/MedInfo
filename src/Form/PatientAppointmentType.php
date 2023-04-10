<?php

namespace App\Form;

use App\Entity\Patitent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PatientAppointmentType extends AbstractType
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
            ->add('Sex', ChoiceType::class,[
                'label' => 'Płeć',
                'choices'  => [
                    'Kobieta' => 'K',
                    'Mężczyzna' => 'M',
                ],
            ])
            ->add('Additional_info', TextareaType::class,[
                'label' => 'Szczegóły',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patitent::class,
        ]);
    }
}
