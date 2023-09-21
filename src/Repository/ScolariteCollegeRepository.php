<?php

namespace App\Repository;

use App\Entity\ScolariteCollege;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ScolariteCollege>
 *
 * @method ScolariteCollege|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScolariteCollege|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScolariteCollege[]    findAll()
 * @method ScolariteCollege[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScolariteCollegeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScolariteCollege::class);
    }

//    /**
//     * @return ScolariteCollege[] Returns an array of ScolariteCollege objects
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

//    public function findOneBySomeField($value): ?ScolariteCollege
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
