<?php

namespace App\Repository;

use App\Entity\ArmePersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Laminas\Code\Reflection\FunctionReflection;

/**
 * @extends ServiceEntityRepository<ArmePersonnage>
 *
 * @method ArmePersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArmePersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArmePersonnage[]    findAll()
 * @method ArmePersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArmePersonnageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArmePersonnage::class);
    }

    public function add(ArmePersonnage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ArmePersonnage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ArmePersonnage[] Returns an array of ArmePersonnage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ArmePersonnage
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
