<?php

namespace App\Repository;

use App\Entity\Arme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Arme>
 *
 * @method Arme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arme[]    findAll()
 * @method Arme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArmeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arme::class);
    }

    public function add(Arme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Arme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByFiltreArme($type,$lvl,$TypeDmg,$nom): array
   {
       $q =  $this->createQueryBuilder('a');
       if($type>0){
        $q->andWhere('a.type = :type')
        ->setParameter('type', $type);
       }
       if($lvl> 0){
        $q->andWhere('a.niveau = :lvl')
        ->setParameter('lvl', $lvl);
       }
       if($TypeDmg!="--"){
        

        $q->andWhere($q->expr()->orX(
            $q->expr()->like('a.TypeDegat', ':var1'),
            $q->expr()->like('a.TypeDegat', ':var2'),
            $q->expr()->eq('a.TypeDegat',':var3')
        ))
        ->setParameter('var1', $TypeDmg.' &%')
        ->setParameter('var2', '%& '.$TypeDmg)
        ->setParameter('var3', $TypeDmg); 
       }
       if(strlen($nom)>0 && $nom!='null'){
        $q->andWhere("a.Titre like :nom")->setParameter('nom', "%".$nom."%");
       }

                    
        $q->orderBy('a.id', 'ASC');
        return $q->getQuery()->getResult();
        
    }
    public function findTypeDmg():array
    {
        $q = $this->createQueryBuilder('a')->select("DISTINCT a.TypeDegat")->getQuery()->getResult();
        $types = [];
        foreach($q as $row)
        {
            if(!str_contains($row["TypeDegat"],"&"))$types[]= $row["TypeDegat"];
        }
        return $types;
    }
//    /**
//     * @return Arme[] Returns an array of Arme objects
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

//    public function findOneBySomeField($value): ?Arme
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
