<?php

namespace App\Repository;

use App\Entity\ClassePrimaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClassePrimaire>
 *
 * @method ClassePrimaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassePrimaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassePrimaire[]    findAll()
 * @method ClassePrimaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassePrimaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassePrimaire::class);
    }

//    /**
//     * @return ClassePrimaire[] Returns an array of ClassePrimaire objects
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

//    public function findOneBySomeField($value): ?ClassePrimaire
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
