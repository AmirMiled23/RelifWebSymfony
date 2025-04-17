<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\ReservationMateriel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_debut', null, [
                'widget' => 'single_text',
                'data' => new \DateTime(), // Définit la date actuelle comme valeur par défaut
                'required' => true,
            ])
            ->add('date_fin', null, [
                'widget' => 'single_text',
            ])
            ->add('quantite_reservee')
            ->add('materiel', EntityType::class, [
                'class' => Materiel::class,
                'choice_label' => 'nomMateriel', // Affiche le nom du matériel dans la liste déroulante
                'placeholder' => 'Sélectionnez un matériel',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationMateriel::class,
        ]);
    }
}
