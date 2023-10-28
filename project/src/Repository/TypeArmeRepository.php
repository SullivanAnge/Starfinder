<?php

namespace App\Repository;

use App\Entity\TypeArme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeArme>
 *
 * @method TypeArme|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeArme|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeArme[]    findAll()
 * @method TypeArme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeArmeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeArme::class);
    }

    public function add(TypeArme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeArme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /*public function findAll(): array
    {
        return $this->getEntityManager()->getRepository(TypeArme::class)->findAll();
    }*/

//    /**
//     * @return TypeArme[] Returns an array of TypeArme objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeArme
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
