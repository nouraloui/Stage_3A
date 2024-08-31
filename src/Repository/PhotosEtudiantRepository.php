<?php

namespace App\Repository;

use App\Entity\PhotosEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PhotosEtudiant>
 *
 * @method PhotosEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotosEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotosEtudiant[]    findAll()
 * @method PhotosEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotosEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotosEtudiant::class);
    }

//    /**
//     * @return PhotosEtudiant[] Returns an array of PhotosEtudiant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PhotosEtudiant
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
