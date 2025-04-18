<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\ReservationMateriel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_debut', DateTimeType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(), // Sets the current date as the default value
                'required' => true,
            ])
            ->add('date_fin', DateTimeType::class, [ // Moved below date_debut
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('quantite_reservee')
            ->add('materiel', EntityType::class, [
                'class' => Materiel::class,
                'choice_label' => 'nomMateriel', // Displays the material name in the dropdown
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
