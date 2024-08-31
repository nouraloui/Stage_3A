<?php

namespace App\Repository;

use App\Entity\EspEnteteNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspEnteteNote>
 *
 * @method EspEnteteNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspEnteteNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspEnteteNote[]    findAll()
 * @method EspEnteteNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspEnteteNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspEnteteNote::class);
    }
    public function findByDateDesc(): array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.DateSaisie', 'DESC')
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return EspEnteteNote[] Returns an array of EspEnteteNote objects
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

//    public function findOneBySomeField($value): ?EspEnteteNote
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
