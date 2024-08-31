<?php

namespace App\Repository;

use App\Entity\EspNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspNote>
 *
 * @method EspNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspNote[]    findAll()
 * @method EspNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspNote::class);
    }

   
//    /**
//     * @return EspNote[] Returns an array of EspNote objects
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

//    public function findOneBySomeField($value): ?EspNote
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
