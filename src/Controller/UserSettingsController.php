<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Address;
use App\Repository\AddressRepository;

class UserSettingsController extends AbstractController
{
    #[Route('/user/settings', name: 'app_user_settings')]
    public function index(AddressRepository $addressRepository): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $Date = $user->getLastPasswordChange();
        $userDate = $Date->format('d/m/Y');

        $getAddressObj = $addressRepository->findOneById($user->getIDAddress());
        $a_country = $getAddressObj->getCountry();
        $a_voivodeship = $getAddressObj->getVoivodeship();
        $a_city = $getAddressObj->getCity();
        $a_zipcode = $getAddressObj->getZIPCode();
        $a_street = $getAddressObj->getStreet();
        $a_buildingNumber = $getAddressObj->getBuildingNumber();
        $a_apartmentNumber = $getAddressObj->getApartmentNumber();

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
}
