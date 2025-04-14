<?php 
namespace App\Form;

use App\Entity\Secteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Define 'nom' field as a TextType field
            ->add('nom', TextType::class, [
                'label' => 'Nom du Secteur', // Optional: Set a custom label
            ])
            // Define 'description' field as a TextareaType field
            ->add('description', TextareaType::class, [
                'label' => 'Description du secteur', // Optional: Set a custom label
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Secteur::class, // Make sure this matches the corresponding entity
        ]);
    }
}
