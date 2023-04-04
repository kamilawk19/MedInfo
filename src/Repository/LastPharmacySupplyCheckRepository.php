<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\LastPharmacySupplyCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LastPharmacySupplyCheck>
 *
 * @method LastPharmacySupplyCheck|null find($id, $lockMode = null, $lockVersion = null)
 * @method LastPharmacySupplyCheck|null findOneBy(array $criteria, array $orderBy = null)
 * @method LastPharmacySupplyCheck[]    findAll()
 * @method LastPharmacySupplyCheck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LastPharmacySupplyCheckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LastPharmacySupplyCheck::class);
    }

    public function save(LastPharmacySupplyCheck $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LastPharmacySupplyCheck $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LastPharmacySupplyCheck[] Returns an array of LastPharmacySupplyCheck objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LastPharmacySupplyCheck
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
