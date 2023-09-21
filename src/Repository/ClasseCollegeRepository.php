<?php

namespace App\Repository;

use App\Entity\ClasseCollege;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClasseCollege>
 *
 * @method ClasseCollege|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasseCollege|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasseCollege[]    findAll()
 * @method ClasseCollege[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseCollegeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClasseCollege::class);
    }

//    /**
//     * @return ClasseCollege[] Returns an array of ClasseCollege objects
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

//    public function findOneBySomeField($value): ?ClasseCollege
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
