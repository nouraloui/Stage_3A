<?php

namespace App\Repository;

use App\Entity\CodeNomenclature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CodeNomenclature>
 *
 * @method CodeNomenclature|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeNomenclature|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeNomenclature[]    findAll()
 * @method CodeNomenclature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeNomenclatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeNomenclature::class);
    }

//    /**
//     * @return CodeNomenclature[] Returns an array of CodeNomenclature objects
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

//    public function findOneBySomeField($value): ?CodeNomenclature
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
