<?php

namespace App\Controller;

use App\Entity\PharmacySupply;
use App\Form\PharmacySupplyType;
use App\Repository\PharmacySupplyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pharmacysupply')]
class PharmacySupplyController extends AbstractController
{
    #[Route('/', name: 'app_pharmacy_supply_index', methods: ['GET'])]
    public function index(PharmacySupplyRepository $pharmacySupplyRepository): Response
    {
        return $this->render('pharmacy_supply/index.html.twig', [
            'pharmacy_supplies' => $pharmacySupplyRepository->findAll(),
            'page_name' => 'Stan apteki oddziałowej',
        ]);
    }

    #[Route('/new', name: 'app_pharmacy_supply_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PharmacySupplyRepository $pharmacySupplyRepository): Response
    {
        $pharmacySupply = new PharmacySupply();
        $form = $this->createForm(PharmacySupplyType::class, $pharmacySupply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pharmacySupplyRepository->save($pharmacySupply, true);

            return $this->redirectToRoute('app_pharmacy_supply_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharmacy_supply/new.html.twig', [
            'pharmacy_supply' => $pharmacySupply,
            'form' => $form,
            'page_name' => 'Stan apteki - dodaj nowy lek',
        ]);
    }

    #[Route('/{id}', name: 'app_pharmacy_supply_show', methods: ['GET'])]
    public function show(PharmacySupply $pharmacySupply): Response
    {
        return $this->render('pharmacy_supply/show.html.twig', [
            'pharmacy_supply' => $pharmacySupply,
            'page_name' => 'Stan - szczegóły',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pharmacy_supply_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PharmacySupply $pharmacySupply, PharmacySupplyRepository $pharmacySupplyRepository): Response
    {
        $form = $this->createForm(PharmacySupplyType::class, $pharmacySupply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pharmacySupplyRepository->save($pharmacySupply, true);

            return $this->redirectToRoute('app_pharmacy_supply_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharmacy_supply/edit.html.twig', [
            'pharmacy_supply' => $pharmacySupply,
            'form' => $form,
            'page_name' => 'Stan apteki- edycja',
        ]);
    }

    #[Route('/{id}', name: 'app_pharmacy_supply_delete', methods: ['POST'])]
    public function delete(Request $request, PharmacySupply $pharmacySupply, PharmacySupplyRepository $pharmacySupplyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharmacySupply->getId(), $request->request->get('_token'))) {
            $pharmacySupplyRepository->remove($pharmacySupply, true);
        }

        return $this->redirectToRoute('app_pharmacy_supply_index', [], Response::HTTP_SEE_OTHER);
    }
}
