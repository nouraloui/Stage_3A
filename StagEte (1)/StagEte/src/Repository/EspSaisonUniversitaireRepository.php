<?php

namespace App\Repository;

use App\Entity\EspSaisonUniversitaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspSaisonUniversitaire>
 *
 * @method EspSaisonUniversitaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspSaisonUniversitaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspSaisonUniversitaire[]    findAll()
 * @method EspSaisonUniversitaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspSaisonUniversitaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspSaisonUniversitaire::class);
    }

//    /**
//     * @return EspSaisonUniversitaire[] Returns an array of EspSaisonUniversitaire objects
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

//    public function findOneBySomeField($value): ?EspSaisonUniversitaire
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
