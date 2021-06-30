<?php

namespace App\Repository;

use App\Entity\Item;
use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function findByFilter($params)
    {

        $db = $this->createQueryBuilder('i')
            ->select('i.id, i.name')
            ->leftJoin('i.tag','t')
            ->where('0=0');

        if(isset($params['with'])) {
            $with = [];
            $q = $this->createQueryBuilder('i')
                ->select('i.id')
                ->leftJoin('i.tag','t')
                ->where('t.id IN('.implode(', ', $params['with']).')')
                ->getQuery()->execute();
            foreach ($q as $row) {
                $with[] = $row['id'];
            }
            $db->andwhere('i.id IN('.implode(', ', $with).')');
        }
        if(isset($params['without'])) {
            $without = [];
            $q = $this->createQueryBuilder('i')
                ->select('i.id')
                ->leftJoin('i.tag','t')
                ->where('t.id IN('.implode(', ', $params['without']).')')
                ->getQuery()->execute();
            foreach ($q as $row) {
                $without[] = $row['id'];
            }
            $db->andwhere('i.id NOT IN('.implode(', ', $without).')');
        }
        $db->groupBy('i.id');

        $query = $db->getQuery();
        return $query->execute();
    }
    // /**
    //  * @return Item[] Returns an array of Item objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Item
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
