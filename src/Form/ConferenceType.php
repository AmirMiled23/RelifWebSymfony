<?php

namespace App\Form;

use App\Entity\Conference;
use App\Entity\Resource;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ])
            ->add('presenteur')
            ->add('lieu')
            ->add('nb_place')
            ->add('prix')
            ->add('theme')
            ->add('status')
            ->add('resource')
            ->add('resources', EntityType::class, [
                'class' => Resource::class,
                'choice_label' => function (Resource $resource) {
                    return $resource->getName() . ' (' . $resource->getType() . ')';
                },
                'choices' => $options['resources'],
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'attr' => [
                    'class' => 'resource-select form-select',
                    'data-live-search' => 'true',
                    'data-placeholder' => 'Select resources...'
                ],
                'label' => 'Resources'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conference::class,
            'resources' => [],
        ]);
    }
}
