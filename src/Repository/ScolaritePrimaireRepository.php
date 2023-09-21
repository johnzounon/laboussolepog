<?php

namespace App\Repository;

use App\Entity\ScolaritePrimaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ScolaritePrimaire>
 *
 * @method ScolaritePrimaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScolaritePrimaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScolaritePrimaire[]    findAll()
 * @method ScolaritePrimaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScolaritePrimaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScolaritePrimaire::class);
    }

//    /**
//     * @return ScolaritePrimaire[] Returns an array of ScolaritePrimaire objects
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

//    public function findOneBySomeField($value): ?ScolaritePrimaire
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
