<?php

namespace App\Repository;

use App\Entity\EspContrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspContrat>
 *
 * @method EspContrat|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspContrat|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspContrat[]    findAll()
 * @method EspContrat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspContratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspContrat::class);
    }

//    /**
//     * @return EspContrat[] Returns an array of EspContrat objects
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

//    public function findOneBySomeField($value): ?EspContrat
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
