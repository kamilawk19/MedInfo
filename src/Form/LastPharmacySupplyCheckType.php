<?php

namespace App\Form;

use App\Entity\LastPharmacySupplyCheck;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvents;

class LastPharmacySupplyCheckType extends AbstractType
{
    private Security $security;
    private UserRepository $userRepository;

    public function __construct(Security $security, UserRepository $userRepository)
    {
        $this->security = $security;
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();
        $userid = $user->getId();
        $userr= $this->userRepository->findOneBy(array('id' => 'userid'));

        $builder
            ->add('Last_Supply_Date', null, [
                'required' => true,
                'label' => 'Data kontroli',
            ])
             ->add('ID_Controller', EntityType::class,[
                'class' => User::class,
                //'data' => $userr,
                //'empty_data' => $userr,
                'choice_label' => function (?User $category) {
                    return $category ? ($category->getLastName().' '.$category->getFirstName()) : '';
                },
                'label' => 'Kontroler',
            ]) 

        ;

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LastPharmacySupplyCheck::class,
        ]);
    }
}
