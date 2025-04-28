<?php

namespace App\Repository;

use App\Entity\Materiel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Materiel>
 */
class MaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiel::class);
    }

    public function findByCriteria(array $criteria, string $sort = 'asc'): array
    {
        $qb = $this->createQueryBuilder('m');

        if (!empty($criteria['nom'])) {
            $qb->andWhere('m.nom_materiel LIKE :nom')
               ->setParameter('nom', '%' . $criteria['nom'] . '%');
        }

        if (!empty($criteria['description'])) {
            $qb->andWhere('m.description LIKE :description')
               ->setParameter('description', '%' . $criteria['description'] . '%');
        }

        if (!empty($criteria['quantiteMin'])) {
            $qb->andWhere('m.quantite_dispo >= :quantiteMin')
               ->setParameter('quantiteMin', $criteria['quantiteMin']);
        }

        if (!empty($criteria['quantiteMax'])) {
            $qb->andWhere('m.quantite_dispo <= :quantiteMax')
               ->setParameter('quantiteMax', $criteria['quantiteMax']);
        }

        $qb->orderBy('m.quantite_dispo', $sort === 'desc' ? 'DESC' : 'ASC');

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Materiel[] Returns an array of Materiel objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Materiel
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
