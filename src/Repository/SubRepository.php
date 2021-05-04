<?php

namespace App\Repository;

use App\Entity\Sub;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sub|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sub|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sub[]    findAll()
 * @method Sub[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sub::class);
    }

    public function select(int $id): ?array
    {
        return $this->createQueryBuilder('s')
            ->select('s.id','s.nom','s.prenom')
            ->where('s.idOffice = :id')
            ->setParameter(':id', $id)
            ->orderBy('s.nom')
            ->getQuery()
            ->getResult();
    }
    public function list(int $id): ?int
    {
        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
            ->where('s.idOffice = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    // /**
    //  * @return Sub[] Returns an array of Sub objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sub
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
