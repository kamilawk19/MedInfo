<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request): Response
    {
        $user=new User();
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'form' => $form,
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
