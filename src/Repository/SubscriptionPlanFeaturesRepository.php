<?php

namespace App\Repository;

use App\Entity\SubscriptionPlanFeatures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubscriptionPlanFeatures>
 *
 * @method SubscriptionPlanFeatures|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubscriptionPlanFeatures|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubscriptionPlanFeatures[]    findAll()
 * @method SubscriptionPlanFeatures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscriptionPlanFeaturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubscriptionPlanFeatures::class);
    }

//    /**
//     * @return SubscriptionPlanFeatures[] Returns an array of SubscriptionPlanFeatures objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SubscriptionPlanFeatures
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
