<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    private UserRepository $userRep;

    public function __construct(UserRepository $ur)
    {
        $this->userRep = $ur;
    }

    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, array('validation_groups'=>array('registration')));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setIsActive(0);
            $user->setRoles(['ROLE_USER']);
            $date = new \DateTime();
            $user->setLastPasswordChange($date);
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword(),
            );
            $user->setPassword($hashedPassword);
            $this->userRep->save($user, true);
            $this->addFlash('success','Zostałeś zarejestrowany. Twój przełożony musi aktywować twoje konto!');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /*
     * public function index(): Response
    {
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
        ]);
    }
     */
}
