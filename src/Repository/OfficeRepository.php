<?php

namespace App\Repository;

use App\Entity\Office;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Office|null find($id, $lockMode = null, $lockVersion = null)
 * @method Office|null findOneBy(array $criteria, array $orderBy = null)
 * @method Office[]    findAll()
 * @method Office[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Office::class);
    }
    // /**
    //  * @return Office[] Returns an array of Office objects
    //  */
    public function office(): ?array
    {
        return $this->createQueryBuilder('o')
            ->select('o.id','o.title')
            ->getQuery()
            ->getArrayResult();
    }

    public function date_office(): ?array
    {
        return $this->createQueryBuilder('o')
            ->select('o.id','o.date')
            ->getQuery()
            ->getArrayResult();
    }

    public function date_office_id(int $id): ?array
    {
        return $this->createQueryBuilder('o')
            ->select('o.id','o.date')
            ->where('o.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getArrayResult();
    }
    /*
    public function findOneBySomeField($value): ?Office
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
