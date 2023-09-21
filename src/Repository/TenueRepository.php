<?php

namespace App\Repository;

use App\Entity\Tenue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tenue>
 *
 * @method Tenue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tenue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tenue[]    findAll()
 * @method Tenue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TenueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tenue::class);
    }

//    /**
//     * @return Tenue[] Returns an array of Tenue objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tenue
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
