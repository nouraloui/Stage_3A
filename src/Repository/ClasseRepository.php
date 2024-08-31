<?php

namespace App\Repository;

use App\Entity\Classe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Classe>
 *
 * @method Classe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classe[]    findAll()
 * @method Classe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classe::class);
    }

    // Uncomment and adjust these methods as needed for your application

    /**
     * @return Classe[] Returns an array of Classe objects
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneBySomeField($value): ?Classe
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findOneById(string $id): ?Classe
    {
        // Convert the string ID to an integer
        $intId = (int) $id;

        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $intId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // Search functionality
    public function search(string $searchTerm): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.libelle_cl LIKE :searchTerm')
            ->orWhere('s.description_cl LIKE :searchTerm')
            ->orWhere('s.date_cr LIKE :searchTerm')
            ->orWhere('s.date_dern_modif LIKE :searchTerm')
            ->orWhere('s.salle_principale LIKE :searchTerm')
            ->orWhere('s.salle_secondaire_1 LIKE :searchTerm')
            ->orWhere('s.salle_secondaire_2 LIKE :searchTerm')
            ->orWhere('s.niveau_accees LIKE :searchTerm')
            ->orWhere('s.filiere LIKE :searchTerm')
            ->orWhere('s.annee_scolaire LIKE :searchTerm')
            ->orWhere('s.catergorie LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$searchTerm.'%')
            ->getQuery()
            ->getResult();
    }

    // Sorting functionality
    public function findAllSortedBy(string $sortField, string $sortOrder)
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.' . $sortField, $sortOrder)
            ->getQuery()
            ->getResult();
    }
}
