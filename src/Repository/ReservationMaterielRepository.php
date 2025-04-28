<?php

namespace App\Repository;

use App\Entity\ReservationMateriel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationMateriel>
 */
class ReservationMaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationMateriel::class);
    }

    //    /**
    //     * @return ReservationMateriel[] Returns an array of ReservationMateriel objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ReservationMateriel
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByCriteria(array $criteria, string $sort = 'asc'): array
    {
        $qb = $this->createQueryBuilder('r')
            ->join('r.materiel', 'm');

        if (!empty($criteria['nomMateriel'])) {
            $qb->andWhere('m.nom_materiel LIKE :nomMateriel')
               ->setParameter('nomMateriel', '%' . $criteria['nomMateriel'] . '%');
        }

        if (!empty($criteria['dateDebut'])) {
            $qb->andWhere('r.date_debut >= :dateDebut')
               ->setParameter('dateDebut', $criteria['dateDebut']);
        }

        if (!empty($criteria['dateFin'])) {
            $qb->andWhere('r.date_fin <= :dateFin')
               ->setParameter('dateFin', $criteria['dateFin']);
        }

        if (!empty($criteria['quantiteMin'])) {
            $qb->andWhere('r.quantite_reservee >= :quantiteMin')
               ->setParameter('quantiteMin', $criteria['quantiteMin']);
        }

        if (!empty($criteria['quantiteMax'])) {
            $qb->andWhere('r.quantite_reservee <= :quantiteMax')
               ->setParameter('quantiteMax', $criteria['quantiteMax']);
        }

        $qb->orderBy('r.date_debut', $sort === 'desc' ? 'DESC' : 'ASC');

        return $qb->getQuery()->getResult();
    }
}
