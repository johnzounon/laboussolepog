<?php

namespace App\Repository;

use App\Entity\ArrieresPrimaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArrieresPrimaire>
 *
 * @method ArrieresPrimaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArrieresPrimaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArrieresPrimaire[]    findAll()
 * @method ArrieresPrimaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArrieresPrimaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArrieresPrimaire::class);
    }

//    /**
//     * @return ArrieresPrimaire[] Returns an array of ArrieresPrimaire objects
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

//    public function findOneBySomeField($value): ?ArrieresPrimaire
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
