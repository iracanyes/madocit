<?php

namespace App\Repository;

use App\Entity\EditorsChats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EditorsChats|null find($id, $lockMode = null, $lockVersion = null)
 * @method EditorsChats|null findOneBy(array $criteria, array $orderBy = null)
 * @method EditorsChats[]    findAll()
 * @method EditorsChats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditorsChatsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EditorsChats::class);
    }

//    /**
//     * @return EditorsChats[] Returns an array of EditorsChats objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EditorsChats
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
