<?php

namespace App\Repository;

use App\Entity\EspInscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspInscription>
 *
 * @method EspInscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspInscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspInscription[]    findAll()
 * @method EspInscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspInscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspInscription::class);
    }

//    /**
//     * @return EspInscription[] Returns an array of EspInscription objects
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

//    public function findOneBySomeField($value): ?EspInscription
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findOneById(string $id): ?EspInscription
{
    return $this->createQueryBuilder('c')
        ->andWhere('c.id LIKE :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getOneOrNullResult();
}


public function search(string $searchTerm, int $id): array
{
    $qb = $this->createQueryBuilder('s')
        ->leftJoin('s.etudiant', 'e')
        ->where('s.annee_deb LIKE :searchTerm')
        ->orWhere('s.esp_annee_deb LIKE :searchTerm')
        ->andWhere('e.id = :id')
        ->setParameter('searchTerm', '%' . $searchTerm . '%')
        ->setParameter('id', $id)
        ->getQuery();

    return $qb->getResult();
}
}
