<?php

namespace App\Repository;

use App\Entity\CycleCollege;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CycleCollege>
 *
 * @method CycleCollege|null find($id, $lockMode = null, $lockVersion = null)
 * @method CycleCollege|null findOneBy(array $criteria, array $orderBy = null)
 * @method CycleCollege[]    findAll()
 * @method CycleCollege[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CycleCollegeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CycleCollege::class);
    }

//    /**
//     * @return CycleCollege[] Returns an array of CycleCollege objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CycleCollege
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
