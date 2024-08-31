<?php

namespace App\Form;

use App\Entity\EspPlanEtude;
use App\Entity\EspEnseignant;
use App\Entity\EspModule;
use App\Entity\Salle;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EspPlanEtudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('code_module', EntityType::class, [
            'class' => EspModule::class,
            'choice_label' => 'code_module',  // Ensure 'name' is a string property in EspModule
            'label' => 'Module',
        ])
            ->add('num_panier', TextType::class, [
                'label' => 'Numéro Panier',
            ])
            ->add('code_cl', TextType::class, [
                'label' => 'Code CL',
            ])
            ->add('annee_deb', TextType::class, [
                'label' => 'Année Début',
            ])
            ->add('annee_fin', TextType::class, [
                'label' => 'Année Fin',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('nb_heures', TextType::class, [
                'label' => 'Nombre d\'Heures',
            ])
            ->add('coef', TextType::class, [
                'label' => 'Coefficient',
            ])
            ->add('num_semestre', TextType::class, [
                'label' => 'Numéro Semestre',
            ])
            ->add('num_periodfe', TextType::class, [
                'label' => 'Numéro Période',
            ])
            ->add('date_debut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date Début',
            ])
            ->add('date_fin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date Fin',
            ])
            ->add('date_examen', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date Examen',
            ])
            ->add('date_rattrapage', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date Rattrapage',
            ])
            ->add('nb_horaire_realises', TextType::class, [
                'label' => 'Nombre d\'Heures Réalisées',
            ])
            ->add('acomptabiliser', TextType::class, [
                'label' => 'À Comptabiliser',
            ])
            ->add('id_ens', EntityType::class, [
                'class' => EspEnseignant::class,
                'choice_label' => 'idEns',
                'label' => 'Enseignant',
            ])
            ->add('esp_annee_deb', TextType::class, [
                'label' => 'Année Début ESP',
            ])
            ->add('code_salle', EntityType::class, [
                'class' => Salle::class,
                'choice_label' => 'codeSalle',
                'label' => 'Salle',
            ])
            ->add('id_ens2', EntityType::class, [
                'class' => EspEnseignant::class,
                'choice_label' => 'idEns',
                'label' => 'Deuxième Enseignant',
                'required' => false,
            ])
            ->add('nb_heures_ens', TextType::class, [
                'label' => 'Nombre d\'Heures Enseignant',
                'required' => false,
            ])
            ->add('nb_heures_ens2', TextType::class, [
                'label' => 'Nombre d\'Heures Deuxième Enseignant',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspPlanEtude::class,
        ]);
    }
}
