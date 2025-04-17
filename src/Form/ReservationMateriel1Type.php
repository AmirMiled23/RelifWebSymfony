<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\ReservationMateriel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationMateriel1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_debut', null, [
                'widget' => 'single_text',
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
