<?php

namespace App\Repository;

use App\Entity\EspPlanEtude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EspPlanEtude>
 *
 * @method EspPlanEtude|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspPlanEtude|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspPlanEtude[]    findAll()
 * @method EspPlanEtude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspPlanEtudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspPlanEtude::class);
    }

    public function findOneByCodeModule(string $codeModule): ?EspPlanEtude
    {
        return $this->findOneBy(['code_module' => $codeModule]);
    }

    // Uncomment and adjust these methods as needed for your application

    /**
     * @return EspPlanEtude[] Returns an array of EspPlanEtude objects
     */
    // public function findByExampleField($value): array
    // {
    //     return $this->createQueryBuilder('e')
    //         ->andWhere('e.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('e.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    // public function findOneBySomeField($value): ?EspPlanEtude
    // {
    //     return $this->createQueryBuilder('e')
    //         ->andWhere('e.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }
}
