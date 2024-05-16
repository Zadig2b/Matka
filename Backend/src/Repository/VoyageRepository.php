<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Voyage;
use DateInterval;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voyage>
 *
 * @method Voyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voyage[]    findAll()
 * @method Voyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voyage::class);
    }

    //    /**
    //     * @return Voyage[] Returns an array of Voyage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Voyage
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findVoyagesFromOthers(User $editor): ?array
    {
        return $this->createQueryBuilder('v')
            ->leftJoin('v.voyage_user', 'u') 
            ->andWhere('u != :editor')
            ->setParameter('editor', $editor)
            ->getQuery()
            ->getResult();
    }

        /**
     * @param string $categoryName
     * @return Voyage[] Returns an array of Voyage objects
     */
    public function findByCategoryName(string $categoryName): array
    {
        return $this->createQueryBuilder('v')
            ->join('v.get_cat', 'cat')
            ->andWhere('cat.nom = :categoryName')
            ->setParameter('categoryName', $categoryName)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $countryName
     * @return Voyage[] Returns an array of Voyage objects
     */
    public function findByCountryName(string $countryName): array
    {
        return $this->createQueryBuilder('v')
            ->join('v.pays', 'p')
            ->andWhere('p.nom = :countryName')
            ->setParameter('countryName', $countryName)
            ->getQuery()
            ->getResult();
    }
    public function findByCountryNameAndCategoryName(string $countryName, string $categoryName): array
    {
        return $this->createQueryBuilder('v')
            ->join('v.pays', 'p')
            ->join('v.get_cat', 'cat')
            ->andWhere('p.nom = :countryName')
            ->andWhere('cat.nom = :categoryName')
            ->setParameter('countryName', $countryName)
            ->setParameter('categoryName', $categoryName)
            ->getQuery()
            ->getResult();
    }

    public function findByDuree(DateInterval $duree): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.duree = :duree')
            ->setParameter('duree', $duree)
            ->getQuery()
            ->getResult();
    }
    
}
