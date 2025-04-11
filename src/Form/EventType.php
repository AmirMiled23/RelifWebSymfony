<?php

namespace App\Form;

use App\Entity\CategorieEvent;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_event')
            ->add('date_event', null, [
                'widget' => 'single_text'
            ])
            ->add('adresse_event')
            ->add('villes',choiceType::class, [
                'choices' => [
                    'Zaghouan' => 'Zaghouan',
                    'Tunis' => 'Tunis',
                    'Sfax' => 'Sfax',
                    'Nabeul' => 'Nabeul',
                    'Sidi Bouzid' => 'Sidi Bouzid',
                    'Siliana' => 'Siliana',
                    'Sousse' => 'Sousse',
                    'Tataouine' => 'Tataouine',
                    'Tozeur' => 'Tozeur',
                    'Monastir' => 'Monastir',
                    'Medenine' => 'Medenine',
                    'Manouba' => 'Manouba',
                    'Mahdia' => 'Mahdia',
                    'Kebili' => 'Kebili',
                    'Kasserine' => 'Kasserine',
                    'Jendouba' => 'Jendouba',
                    'Gafsa' => 'Gafsa',
                    'Gabes' => 'Gabes',
                    'El Kef' => 'El Kef',
                    'Bizerte' => 'Bizerte',
                    'Ben Arous' => 'Ben Arous',
                    'Beja' => 'Beja',
                    'Ariana' => 'Ariana',
                    'Kairouan' => 'Kairouan',
                ],
                'placeholder' => 'Choisissez une ville',
                'required' => true,
            ])
            ->add('description_event')
            ->add('status_event', ChoiceType::class, [
                'choices' => [
                    'En cours' => 'en_cours',
                    'Terminé' => 'terminé',
                    'Non commencé' => 'non_commencé',
                    '' => '',
                ],
                'placeholder' => 'Sélectionnez un statut',
            ])
            ->add('nb_participant_max')
            ->add('categorieEvent', EntityType::class, [
                'class' => CategorieEvent::class,
'choice_label' => 'nom_categorie',
'label' => 'catégorie',
'placeholder' => 'choisissez une catégorie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
