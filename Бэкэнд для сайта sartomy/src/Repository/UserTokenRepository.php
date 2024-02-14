<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends ServiceEntityRepository<UserToken>
 *
 * @method UserToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserToken[]    findAll()
 * @method UserToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserToken::class);
    }
    public function save(UserToken $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function checkDelay($token, $date)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.token=:token')
            ->setParameter('token', $token)
            ->andWhere('u.active_until >= :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findActive($userId)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.userId = :userId')
            ->setParameter('userId', $userId)
            ->andWhere('u.isActive = :true')
            ->setParameter('true', true)
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return UserToken[] Returns an array of UserToken objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserToken
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
