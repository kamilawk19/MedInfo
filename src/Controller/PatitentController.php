<?php

namespace App\Controller;

use App\Entity\Patitent;
use App\Form\PatitentType;
use App\Repository\PatitentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/patients')]
#[IsGranted('ROLE_USER')]
class PatitentController extends AbstractController
{

    #[Route('/', name: 'app_patitent_index', methods: ['GET'])]
    public function index(PatitentRepository $patitentRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('patitent/index.html.twig', [
            'patitents' => $patitentRepository->findAll(),
            'page_name' => 'Spis pacjentów',
        ]);
    }

    #[Route('/new', name: 'app_patitent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatitentRepository $patitentRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $patitent = new Patitent();
        $form = $this->createForm(PatitentType::class, $patitent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patitentRepository->save($patitent, true);

            return $this->redirectToRoute('app_patitent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patitent/new.html.twig', [
            'patitent' => $patitent,
            'form' => $form,
            'page_name' => 'Dodanie pacjenta',
        ]);
    }

    #[Route('/{id}', name: 'app_patitent_show', methods: ['GET'])]
    public function show(Patitent $patitent): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('patitent/show.html.twig', [
            'patitent' => $patitent,
            'page_name' => 'Dane pacjenta',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_patitent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patitent $patitent, PatitentRepository $patitentRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(PatitentType::class, $patitent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patitentRepository->save($patitent, true);

            return $this->redirectToRoute('app_patitent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patitent/edit.html.twig', [
            'patitent' => $patitent,
            'form' => $form,
            'page_name' => 'Edycja danych pacjenta',
        ]);
    }

    #[Route('/{id}', name: 'app_patitent_delete', methods: ['POST'])]
    public function delete(Request $request, Patitent $patitent, PatitentRepository $patitentRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->isCsrfTokenValid('delete'.$patitent->getId(), $request->request->get('_token'))) {
            $patitentRepository->remove($patitent, true);
        }

        return $this->redirectToRoute('app_patitent_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/history/{id}', name: 'app_patitent_history', methods: ['GET'])]
    public function history(Patitent $patitent): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('patitent/history.html.twig', [
            'patitent' => $patitent,
            'page_name' => 'Historia leczenia pacjenta',
        ]);
    }
}
