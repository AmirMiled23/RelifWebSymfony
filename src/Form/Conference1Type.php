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
                'attr' => ['class' => 'form-control'],
            ])
            ->add('date_conference', null, [
                'widget' => 'single_text',
                'label' => 'Date de la conférence',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('presenteur', null, [
                'label' => 'Présentateur',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('lieu', null, [
                'label' => 'Lieu',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('nb_place', null, [
                'label' => 'Nombre de places',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('prix', null, [
                'label' => 'Prix',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('theme', null, [
                'label' => 'Thème',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('status', null, [
                'label' => 'Statut',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('resource', null, [
                'label' => 'Ressource',
                'attr' => ['class' => 'form-control'],
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
