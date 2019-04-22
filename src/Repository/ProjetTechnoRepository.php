<?php

namespace App\Repository;

use App\Entity\ProjetTechno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjetTechno|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetTechno|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetTechno[]    findAll()
 * @method ProjetTechno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetTechnoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjetTechno::class);
    }

    // /**
    //  * @return ProjetTechno[] Returns an array of ProjetTechno objects
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
    public function findOneBySomeField($value): ?ProjetTechno
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
