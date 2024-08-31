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

public function findAllSortedBy($sortField, $sortOrder)
{
    return $this->createQueryBuilder('c')
        ->orderBy('c.' . $sortField, $sortOrder)
        ->getQuery()
        ->getResult();
}

public function search(string $searchTerm): array
{
    $qb = $this->createQueryBuilder('s')
        ->where('s.date_demarrage LIKE :searchTerm')
        ->orWhere('s.description LIKE :searchTerm')
        ->orWhere('s.code_cl LIKE :searchTerm')
        ->orWhere('s.nb_etudiant LIKE :searchTerm')
        ->orWhere('s.salle_principale LIKE :searchTerm')
        ->orWhere('s.salle_secondaire_1 LIKE :searchTerm')
        ->orWhere('s.salle_secondaire_2 LIKE :searchTerm')
        ->orWhere('s.nature LIKE :searchTerm')
        ->orWhere('s.type_classe LIKE :searchTerm')
        ->orWhere('s.nb_seance LIKE :searchTerm')
        ->orWhere('s.classe_entreprise LIKE :searchTerm')
        ->orWhere('s.semestre LIKE :searchTerm')
        ->orWhere('s.cl_eclate LIKE :searchTerm')
        ->orWhere('s.annee_deb LIKE :searchTerm')
        ->setParameter('searchTerm', '%'.$searchTerm.'%')
       
        ->getQuery();

    return $qb->getResult();
}

}
