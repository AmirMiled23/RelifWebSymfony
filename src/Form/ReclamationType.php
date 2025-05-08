<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Title cannot be empty.']),
                    new Assert\Length([
                        'max' => 255,
                        'min' => 3,
                        'maxMessage' => 'The title cannot be longer than {{ limit }} characters.',
                        'minMessage' => 'The title must be at least {{ limit }} characters long.',
                    ]),
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Service' => 'Service',
                    'Product' => 'Product',
                    'Support' => 'Support',
                    'Billing' => 'Billing',
                    'Other' => 'Other',
                ],
                'placeholder' => 'Choose a type',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Type cannot be empty.',
                    ]),
                ]
            ])
            ->add('description', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Description cannot be empty.']),
                    new Assert\Length([
                        'min' => 8,
                        'minMessage' => 'The description must be at least {{ limit }} characters long.',
                    ]),
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => false,  // Optional email field, set to true if required
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\Email([
                        'message' => 'Please provide a valid email address.',
                        'mode' => 'strict',
                    ]),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
