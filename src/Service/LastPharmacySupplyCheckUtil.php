<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\LastPharmacySupplyCheckRepository;


class LastPharmacySupplyCheckUtil
{

    /**
     * @var UserRepository
     */
    private $UserRepository;
    /**
     * @var LastPharmacySupplyCheckRepository
     */
    private $LastPharmacySupplyCheckRepository;

    public function __construct(UserRepository $UserRepository, LastPharmacySupplyCheckRepository $LastPharmacySupplyCheckRepository)
    {

        $this->UserRepository = $UserRepository;
        $this->LastPharmacySupplyCheckRepository = $LastPharmacySupplyCheckRepository;
    }


    public function getSuppliesForUser( $name, $surname): array
    {
        $user=$this->UserRepository->findOneBy([
            "First_Name" => $name,
            "Last_Name" => $surname
        ]);

        $supplies=$this->getWeatherForLocation($user);
        return $supplies;
    }

    public function getSupplyForUser( User $user):array
    {
        $sup= $this->LastPharmacySupplyCheckRepository->findByUser($user);
		return $sup;
    }
}