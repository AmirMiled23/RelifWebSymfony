<?php

namespace App\Form;

use App\Entity\Conference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConferenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('date_conference', null, [
                'widget' => 'single_text',
                'label' => 'Date de la conférence',
                'attr' => ['class' => 'form-control', 'id' => 'conference_date_conference'],
            ])
            ->add('presenteur')
            ->add('lieu')
            ->add('nb_place')
            ->add('prix')
            ->add('theme')
            ->add('status')
            ->add('resource')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conference::class,
        ]);
    }
}
