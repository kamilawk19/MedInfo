<?php

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Address;
use App\Form\AddressType;

class UserDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('First_Name', TextType::Class, array(
                'label'=>'Imię',
            ))
            ->add('Second_Name', TextType::Class, array(
                'label'=>'Drugie imię',
                'required' => false
            ))
            ->add('Last_Name', TextType::Class, array(
                'label'=>'Nazwisko'
            ))
            ->add('ID_Address', AddressType::class) 
            ->add('Zapisz', SubmitType::Class, array(
                'attr'=>['class'=>'btn btn-primary btn-link']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
