<?php
namespace App\Repository;

use App\Entity\Sponsor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sponsor>
 */
class SponsorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sponsor::class);
    }

    /**
     * Récupère le nombre de sponsors par secteur.
     * 
     * @return array Tableau contenant les secteurs et le nombre de sponsors
     */
    public function countSponsorsBySecteur(): array
    {
        return $this->createQueryBuilder('s')
            ->select('secteur.nom AS secteur_nom', 'COUNT(s.id) AS count')  // Renommer l'alias 'secteur' en 'secteur_nom'
            ->join('s.secteur', 'secteur')
            ->groupBy('secteur.id')  // Grouper par le nom du secteur
            ->getQuery()
            ->getResult();
    }
  /**
     * Récupère un sponsor par son nom.
     *
     * @param string $nom Le nom du sponsor à rechercher
     * @return Sponsor|null Le sponsor trouvé ou null si non trouvé
     */
   public function findByNom(string $nom): ?Sponsor
   {
       return $this->createQueryBuilder('s')
           ->andWhere('s.nom = :nom')
           ->setParameter('nom', $nom)
           ->getQuery()
           ->getOneOrNullResult();  // Renvoie un seul résultat ou null si aucun sponsor trouvé
   }
}
