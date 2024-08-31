<?php
namespace App\Form;

use App\Entity\EspContrat;
use App\Entity\EspEnseignant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EspContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numord', TextType::class)
            // ->add('enseignant', EntityType::class, [
            //     'class' => EspEnseignant::class,
            //     'choice_label' => 'name', // Adjust based on the property you want to display
            // ])
            ->add('annee', TextType::class)
            ->add('date_etab', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('diplome', TextType::class)
            ->add('grade', TextType::class)
            ->add('institution', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspContrat::class,
        ]);
    }
}

