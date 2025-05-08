<?php

namespace App\Form;

use App\Entity\Conference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Conference1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'label' => 'Titre',
                'attr' => ['class' => 'form-control', 'id' => 'conference_titre'],
            ])
            ->add('date_conference', null, [
                'widget' => 'single_text',
                'label' => 'Date de la conférence',
                'attr' => ['class' => 'form-control', 'id' => 'conference_date_conference'],
            ])
            ->add('presenteur', null, [
                'label' => 'Présentateur',
                'attr' => ['class' => 'form-control', 'id' => 'conference_presenteur'],
            ])
            ->add('lieu', null, [
                'label' => 'Lieu',
                'attr' => ['class' => 'form-control', 'id' => 'conference_lieu'],
            ])
            ->add('nb_place', null, [
                'label' => 'Nombre de places',
                'attr' => ['class' => 'form-control', 'id' => 'conference_nb_place'],
            ])
            ->add('prix', null, [
                'label' => 'Prix',
                'attr' => ['class' => 'form-control', 'id' => 'conference_prix'],
            ])
            ->add('theme', null, [
                'label' => 'Thème',
                'attr' => ['class' => 'form-control', 'id' => 'conference_theme'],
            ])
            ->add('status', null, [
                'label' => 'Statut',
                'attr' => ['class' => 'form-control', 'id' => 'conference_status'],
            ])
            ->add('resource', null, [
                'label' => 'Ressource',
                'attr' => ['class' => 'form-control', 'id' => 'conference_resource'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conference::class,
        ]);
    }
}
