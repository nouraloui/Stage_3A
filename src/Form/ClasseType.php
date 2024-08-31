<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\EspSaisonClasse;
use App\Entity\Compteur;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use App\Enum\CatergorieClasse;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Saison', EntityType::class, [
            'class' => EspSaisonClasse::class,
            'choice_label' => 'annee_deb', 
            'multiple' => false,
            'expanded' => false, 
            'attr' => ['class' => 'form-control'],
        ])

        ->add('code_cl', EntityType::class, [
            'class' => Compteur::class,
            'choice_label' => 'lib_cpt', 
            'multiple' => false,
            'expanded' => false, 
            'attr' => ['class' => 'form-control'],
        ])
        ->add('libelle_cl', null, ['attr' => ['class' => 'form-control']])
        ->add('description_cl', null, ['attr' => ['class' => 'form-control']])
        ->add('date_cr', null, ['attr' => ['class' => 'form-control']])
        ->add('date_dern_modif', null, ['attr' => ['class' => 'form-control']])
        ->add('salle_principale', null, ['attr' => ['class' => 'form-control']])
        ->add('salle_secondaire_1', null, ['attr' => ['class' => 'form-control']])
        ->add('salle_secondaire_2', null, ['attr' => ['class' => 'form-control']])
        ->add('niveau_accees', null, ['attr' => ['class' => 'form-control']])
        ->add('filiere', null, ['attr' => ['class' => 'form-control']])
        ->add('annee_scolaire', null, ['attr' => ['class' => 'form-control']])
        ->add('ouvert', null, ['attr' => ['class' => 'form-control']])
        ->add('ouvert', ChoiceType::class, [
            'choices'  => [
                'Ouvert' => true,
                'Fermer' => false,
            ],
            'attr' => ['class' => 'form-control']
        ])
        ->add('catergorie', EnumType::class, [
            'class' => CatergorieClasse::class,
            'multiple' => false,
            'expanded' => false, 
            'attr' => ['class' => 'form-control'],
        ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}



class ClasseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code_cl', TextType::class, ['required' => false])
            ->add('libelle_cl', TextType::class, ['required' => false])
            ->add('description_cl', TextType::class, ['required' => false])
            ->add('date_cr', DateType::class, ['widget' => 'single_text', 'required' => false])
            ->add('salle_principale', TextType::class, ['required' => false])
            ->add('niveau_access', TextType::class, ['required' => false])
            ->add('filiere', TextType::class, ['required' => false])
            ->add('annee_scolaire', TextType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
