<?php

namespace App\Repository;

use App\Entity\EspModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspModule>
 *
 * @method EspModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspModule[]    findAll()
 * @method EspModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspModule::class);
    }

//    /**
//     * @return EspModule[] Returns an array of EspModule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EspModule
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
