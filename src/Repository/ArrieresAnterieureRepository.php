<?php

namespace App\Repository;

use App\Entity\ArrieresAnterieure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArrieresAnterieure>
 *
 * @method ArrieresAnterieure|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArrieresAnterieure|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArrieresAnterieure[]    findAll()
 * @method ArrieresAnterieure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArrieresAnterieureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArrieresAnterieure::class);
    }

//    /**
//     * @return ArrieresAnterieure[] Returns an array of ArrieresAnterieure objects
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

//    public function findOneBySomeField($value): ?ArrieresAnterieure
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
