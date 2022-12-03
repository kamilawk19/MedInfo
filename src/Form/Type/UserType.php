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

class UserType extends AbstractType
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
            ->add('is_active', HiddenType::Class)
            ->add('username', TextType::Class, array(
                'label' => 'Login',
            ))
            ->add('password', RepeatedType::Class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Hasła muszą być takie same',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Hasło'],
                'second_options' => ['label' => 'Powtórz hasło'],
            ))
//            ->add('password2', PasswordType::Class, array(
//                'label' => 'Powtórz hasło',
//                "mapped" => false,
//            ))
            ->add('Last_Password_Change', HiddenType::Class)
            ->add('Zarejestruj', SubmitType::Class, array(
                'attr'=>['class'=>'btn btn-primary btn-link']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['registration'],
        ]);
    }
}
