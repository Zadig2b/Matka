<?php

namespace App\Repository;

use App\Entity\DemandeGenerale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DemandeGenerale>
 *
 * @method DemandeGenerale|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeGenerale|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeGenerale[]    findAll()
 * @method DemandeGenerale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeGeneraleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeGenerale::class);
    }

    //    /**
    //     * @return DemandeGenerale[] Returns an array of DemandeGenerale objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DemandeGenerale
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
