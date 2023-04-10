<?php

namespace App\Controller;

use App\Entity\LastPharmacySupplyCheck;
use App\Form\LastPharmacySupplyCheckType;
use App\Repository\LastPharmacySupplyCheckRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

#[Route('/supplycheck')]
#[IsGranted('ROLE_USER')]
class LastPharmacySupplyCheckController extends AbstractController
{
    #[Route('/', name: 'app_last_pharmacy_supply_check_index', methods: ['GET'])]
    public function index(LastPharmacySupplyCheckRepository $lastPharmacySupplyCheckRepository, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $all_supply=$lastPharmacySupplyCheckRepository->findAll();
        return $this->render('last_pharmacy_supply_check/index.html.twig', [
            'last_pharmacy_supply_checks' => $all_supply,
            'page_name' => 'Kontrole stanu apteki',
        ]);
    }

    #[Route('/new', name: 'app_last_pharmacy_supply_check_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LastPharmacySupplyCheckRepository $lastPharmacySupplyCheckRepository, UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $lastPharmacySupplyCheck = new LastPharmacySupplyCheck();
        $form = $this->createForm(LastPharmacySupplyCheckType::class, $lastPharmacySupplyCheck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $lastPharmacySupplyCheckRepository->save($lastPharmacySupplyCheck, true);

            return $this->redirectToRoute('app_last_pharmacy_supply_check_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('last_pharmacy_supply_check/new.html.twig', [
            'last_pharmacy_supply_check' => $lastPharmacySupplyCheck,
            'form' => $form,
            'page_name' => 'Kontrola stanu apteki - nowy wpis',
        ]);
    }

    #[Route('/{id}', name: 'app_last_pharmacy_supply_check_show', methods: ['GET'])]
    public function show(LastPharmacySupplyCheck $lastPharmacySupplyCheck): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('last_pharmacy_supply_check/show.html.twig', [
            'last_pharmacy_supply_check' => $lastPharmacySupplyCheck,
            'page_name' => 'Kontrola stanu apteki - szczegóły',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_last_pharmacy_supply_check_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LastPharmacySupplyCheck $lastPharmacySupplyCheck, LastPharmacySupplyCheckRepository $lastPharmacySupplyCheckRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(LastPharmacySupplyCheckType::class, $lastPharmacySupplyCheck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lastPharmacySupplyCheckRepository->save($lastPharmacySupplyCheck, true);

            return $this->redirectToRoute('app_last_pharmacy_supply_check_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('last_pharmacy_supply_check/edit.html.twig', [
            'last_pharmacy_supply_check' => $lastPharmacySupplyCheck,
            'form' => $form,
            'page_name' => 'Kontrola stanu apteki - edycja',
        ]);
    }

    #[Route('/{id}', name: 'app_last_pharmacy_supply_check_delete', methods: ['POST'])]
    public function delete(Request $request, LastPharmacySupplyCheck $lastPharmacySupplyCheck, LastPharmacySupplyCheckRepository $lastPharmacySupplyCheckRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->isCsrfTokenValid('delete'.$lastPharmacySupplyCheck->getId(), $request->request->get('_token'))) {
            $lastPharmacySupplyCheckRepository->remove($lastPharmacySupplyCheck, true);
        }

        return $this->redirectToRoute('app_last_pharmacy_supply_check_index', [], Response::HTTP_SEE_OTHER);
    }
}
