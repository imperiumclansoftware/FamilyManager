<?php

namespace App\Repository;

use App\Entity\Nom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nom[]    findAll()
 * @method Nom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BanqueRepository extends ServiceEntityRepository
{
    /**
     * function du construc
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Banque::class);
    }   //--- Fin du construc

    /**
     * Repository pour compter le nombre de Compte
     *
     * @return void
     */
    public function countAllBanque()
    {
        $queryBuiler = $this->createQueryBuilder('a');
        $queryBuiler->select('COUNT(a.id) as value');

        return $queryBuiler->getQuery()->getResult();
    }   //--- Fin de la function countAllBanque


    // /**
    //  * @return Nom[] Returns an array of Nom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nom
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
