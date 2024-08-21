<?php

namespace App\Repository;

use App\Entity\EspEnseignant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspEnseignant>
 *
 * @method EspEnseignant|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspEnseignant|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspEnseignant[]    findAll()
 * @method EspEnseignant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspEnseignantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspEnseignant::class);
    }

//    /**
//     * @return EspEnseignant[] Returns an array of EspEnseignant objects
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

//    public function findOneBySomeField($value): ?EspEnseignant
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
