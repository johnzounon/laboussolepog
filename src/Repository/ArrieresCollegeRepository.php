<?php

namespace App\Repository;

use App\Entity\ArrieresCollege;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArrieresCollege>
 *
 * @method ArrieresCollege|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArrieresCollege|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArrieresCollege[]    findAll()
 * @method ArrieresCollege[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArrieresCollegeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArrieresCollege::class);
    }

//    /**
//     * @return ArrieresCollege[] Returns an array of ArrieresCollege objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ArrieresCollege
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
