<?php

namespace App\Repository;

use App\Entity\PropositionAchat;
use App\Entity\Vendeur;
use App\Repository\VendeurRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method PropositionAchat|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropositionAchat|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropositionAchat[]    findAll()
 * @method PropositionAchat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropositionAchatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropositionAchat::class);
    }

    /**public function findForVendeur($value)
    {
        return $this->createQueryBuilder('p')
            ->join('annonce','a',Join::ON, 'a.id' = 'p.id_annonce_id')
            ->join('bien','b',Join::ON, 'a.id' = 'b.id')
            ->join('vendeur','v',Join::ON, 'b.vendeur_id' = 'v.id')
            ->andWhere('v.id = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
     **/
    // /**
    //  * @return PropositionAchat[] Returns an array of PropositionAchat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropositionAchat
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
