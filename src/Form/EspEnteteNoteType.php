<?php

namespace App\Form;

use App\Entity\EspEnseignant;
use App\Entity\EspModule;
use App\Entity\EspEnteteNote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EspEnteteNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_module', EntityType::class, [
                'class' => EspModule::class,
                'choice_label' => 'code_module', 
                'label' => 'Module',
            ])
            ->add('code_cl', TextType::class, [
                'label' => 'Code CL',
            ])
            ->add('annee_deb', TextType::class, [
                'label' => 'Année Début',
            ])
            ->add('id_ens', EntityType::class, [
                'class' => EspEnseignant::class,
                'choice_label' => 'idEns', 
                'label' => 'Enseignant',
            ])
            ->add('DateSaisie', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de Saisie',
            ])
            ->add('Semestre', IntegerType::class, [
                'label' => 'Semestre',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspEnteteNote::class,
        ]);
    }
}
