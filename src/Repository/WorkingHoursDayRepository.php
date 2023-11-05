<?php

namespace App\Repository;

use App\Entity\WorkingHoursDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WorkingHoursDay>
 *
 * @method WorkingHoursDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkingHoursDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkingHoursDay[]    findAll()
 * @method WorkingHoursDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkingHoursDayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkingHoursDay::class);
    }

//    /**
//     * @return WorkingHoursDay[] Returns an array of WorkingHoursDay objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WorkingHoursDay
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
