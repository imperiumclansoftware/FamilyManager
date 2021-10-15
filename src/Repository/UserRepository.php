<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    /**
     * C'est mon constructeur.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(PersistenceManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    //--- Fin de la function construct

    /**
     * Repository pour compter le nombre d'utilisateur.
     *
     * @return void
     */
    public function countAllUser()
    {
        $queryBuiler = $this->createQueryBuilder('a');
        $queryBuiler->select('COUNT(a.id) as value');

        return $queryBuiler->getQuery()->getResult();
    }

    //--- Fin de la function countAllUser

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        // set the new encoded password on the User object
        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        // execute the queries on the database
        $this->_em->flush();
    }

    /**
     * @return User[] Returns an array of User objects
     */
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
