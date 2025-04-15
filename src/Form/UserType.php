<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_user')
            ->add('prenom_user')
            ->add('email_user')
            ->add('num_user')
            ->add('adresse_user')
            ->add('age_user')
            ->add('point_user')
            ->add('pw_user')
            ->add('date_inscri', null, [
                'widget' => 'single_text',
            ])
            ->add('reset_code')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
