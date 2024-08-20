<?php

namespace App\Repository;

use App\Entity\ChampStr2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChampStr2>
 *
 * @method ChampStr2|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChampStr2|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChampStr2[]    findAll()
 * @method ChampStr2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChampStr2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChampStr2::class);
    }

//    /**
//     * @return ChampStr2[] Returns an array of ChampStr2 objects
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

//    public function findOneBySomeField($value): ?ChampStr2
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
