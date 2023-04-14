<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Address;
use App\Entity\User;
use App\Repository\AddressRepository;
use App\Repository\UserRepository;
use App\Form\Type\UserDataType;

#[IsGranted('ROLE_USER')]
class UserSettingsController extends AbstractController
{
    #[Route('/user/settings', name: 'app_user_settings')]
    public function index(AddressRepository $addressRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $Date = $user->getLastPasswordChange();
        $userDate = $Date->format('d/m/Y');

        $getAddressObj = $addressRepository->findOneById($user->getIDAddress());
        $a_country = $getAddressObj ? $getAddressObj->getCountry() : null;
        $a_voivodeship = $getAddressObj ? $getAddressObj->getVoivodeship() : null;
        $a_city = $getAddressObj ? $getAddressObj->getCity() : null;
        $a_zipcode = $getAddressObj ? $getAddressObj->getZIPCode() : null;
        $a_street = $getAddressObj ? $getAddressObj->getStreet() : null;
        $a_buildingNumber = $getAddressObj ? $getAddressObj->getBuildingNumber() : null;
        $a_apartmentNumber = $getAddressObj ? $getAddressObj->getApartmentNumber() : null;

        return $this->render('user_settings/index.html.twig', [
            'controller_name' => 'UserSettingsController',
            'page_name' => 'Ustawienia',
            'userDate' => $userDate,
            'country' => $a_country,
            'voivodeship' => $a_voivodeship,
            'city' => $a_city,
            'zipcode' => $a_zipcode,
            'street' => $a_street,
            'buildingNumber' => $a_buildingNumber,
            'apartmentNumber' => $a_apartmentNumber,
        ]);
    }

    #[Route('/user/settings/change-personal-data', name: 'app_user_personal_data', methods: ['GET', 'POST'])]
    public function personal_data(Request $request, AddressRepository $addressRepository, UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = new User();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm(UserDataType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $userRepository->save($user, true);
            return $this->redirectToRoute('app_user_settings', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('user_settings/change.html.twig', [
            'user' => $user,
            'form' => $form,
            'page_name' => 'Ustawienia - zmiana danych',
        ]);

    }

}
