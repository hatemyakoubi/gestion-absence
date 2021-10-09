<?php

namespace App\Repository;

use App\Entity\SeanceCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SeanceCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeanceCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeanceCours[]    findAll()
 * @method SeanceCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeanceCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeanceCours::class);
    }

     /**
      * @param int $id
     * @return SeanceCours[] 
     *
     */
    public function findBySeanceCours(int $id)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    

 /*
    public function findOneBySomeField($value): ?SeanceCours
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
