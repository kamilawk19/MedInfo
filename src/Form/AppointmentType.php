<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Patitent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Has_Happened', null,[
                'label' => 'Wykonano',
            ])
            ->add('Start', null,[
                'label' => 'Początek',
                'placeholder' => ['year' => 'Rok', 'month' => 'Miesiąc', 'day' => 'Dzień',
                'hour' => 'Godzina', 'minute' => 'Minuta', 'second' => 'Sekunda',],
            ])
            ->add('End', null,[
                'label' => 'Koniec',
                'placeholder' => [
                'year' => 'Rok', 'month' => 'Miesiąc', 'day' => 'Dzień',
                'hour' => 'Godzina', 'minute' => 'Minuta', 'second' => 'Sekunda',],
            ])
            //->add('ID_Patient', PatientAppointmentType::class)
            ->add('ID_Dialysis', DialysisType::class)
            ->add('ID_Patient', EntityType::class,[
                'class' => Patitent::class,
                'choice_label' => function (?Patitent $p) {
                    return $p ? ($p->getPESEL().' '.$p->getDocumentNumber()) : '';
                },
                'label' => 'Pacjent ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
