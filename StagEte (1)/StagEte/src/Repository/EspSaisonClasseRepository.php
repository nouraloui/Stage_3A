<?php

namespace App\Repository;

use App\Entity\EspSaisonClasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspSaisonClasse>
 *
 * @method EspSaisonClasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspSaisonClasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspSaisonClasse[]    findAll()
 * @method EspSaisonClasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspSaisonClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspSaisonClasse::class);
    }

//    /**
//     * @return EspSaisonClasse[] Returns an array of EspSaisonClasse objects
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

//    public function findOneBySomeField($value): ?EspSaisonClasse
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
