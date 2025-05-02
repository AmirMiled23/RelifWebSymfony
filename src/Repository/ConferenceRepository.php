<?php

namespace App\Repository;

use App\Entity\Conference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conference>
 */
class ConferenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conference::class);
    }

    //    /**
    //     * @return Conference[] Returns an array of Conference objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Conference
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Finds conferences based on various filter criteria.
     *
     * @param array $filters An associative array of filters (e.g., ['topic' => 'AI', 'types' => ['workshop', 'talk']])
     * @return Conference[] Returns an array of Conference objects matching the filters
     */
    public function findWithFilters(array $filters): array
    {
        $qb = $this->createQueryBuilder('c');

        // Filter by topic (theme) - assuming 'topic' filter corresponds to 'theme' field
        if (!empty($filters['topic'])) {
            $qb->andWhere('c.theme LIKE :topic')
               ->setParameter('topic', '%' . $filters['topic'] . '%');
        }

        // Filter by speaker (presenteur)
        if (!empty($filters['speaker'])) {
            $qb->andWhere('c.presenteur LIKE :speaker')
               ->setParameter('speaker', '%' . $filters['speaker'] . '%');
        }

        // Filter by location (lieu)
        if (!empty($filters['location'])) {
            $qb->andWhere('c.lieu LIKE :location')
               ->setParameter('location', '%' . $filters['location'] . '%');
        }

        // Filter by types (theme) - assuming 'types' filter corresponds to 'theme' field
        if (!empty($filters['types']) && is_array($filters['types'])) {
            // Use IN condition for multiple types
            $qb->andWhere($qb->expr()->in('LOWER(c.theme)', ':types'))
               ->setParameter('types', array_map('strtolower', $filters['types'])); // Ensure case-insensitivity
        }

        // Add ordering if needed, e.g., by date
        $qb->orderBy('c.date_conference', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
