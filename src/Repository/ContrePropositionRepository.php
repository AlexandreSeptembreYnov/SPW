<?php

namespace App\Repository;

use App\Entity\ContreProposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContreProposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContreProposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContreProposition[]    findAll()
 * @method ContreProposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContrePropositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContreProposition::class);
    }

    // /**
    //  * @return ContreProposition[] Returns an array of ContreProposition objects
    //  */
    /*
    public function findByExampleField($value)
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
    */

    /*
    public function findOneBySomeField($value): ?ContreProposition
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
