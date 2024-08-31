<?php

namespace App\Form;

use App\Entity\EspInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Compteur;
use App\Entity\EspEtudiant;

class EspInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('id', null, ['attr' => ['class' => 'form-control']])
            ->add('esp_annee_deb', null, ['attr' => ['class' => 'form-control']])
            ->add('annee_deb', null, ['attr' => ['class' => 'form-control']])
            ->add('cout_annuel', null, ['attr' => ['class' => 'form-control']])
            ->add('frais_ins', null, ['attr' => ['class' => 'form-control']])
            ->add('type_rglt', null, ['attr' => ['class' => 'form-control']])
            ->add('mode_rglt', null, ['attr' => ['class' => 'form-control']])
            ->add('code_dev', null, ['attr' => ['class' => 'form-control']])
            ->add('cout_dev', null, ['attr' => ['class' => 'form-control']])
            ->add('sit_rglt', null, ['attr' => ['class' => 'form-control']])
            ->add('credit_rglt', null, ['attr' => ['class' => 'form-control']])
            ->add('nb_credit_module', null, ['attr' => ['class' => 'form-control']])
            ->add('moy_sem1', null, ['attr' => ['class' => 'form-control']])
            ->add('moy_sem2', null, ['attr' => ['class' => 'form-control']])
            ->add('moy_general', null, ['attr' => ['class' => 'form-control']])
            ->add('resultat', null, ['attr' => ['class' => 'form-control']])
            ->add('niveau_accees', null, ['attr' => ['class' => 'form-control']])
            ->add('type_insc', null, ['attr' => ['class' => 'form-control']])
            ->add('niv_langue', null, ['attr' => ['class' => 'form-control']])
            ->add('code_cl_langue', null, ['attr' => ['class' => 'form-control']])
            ->add('utilisateur', null, ['attr' => ['class' => 'form-control']])
            ->add('dern_utilisateur', null, ['attr' => ['class' => 'form-control']])
            ->add('date_preinsc', null, ['attr' => ['class' => 'form-control']])
            ->add('date_insc', null, ['attr' => ['class' => 'form-control']])
            ->add('code_cl1', null, ['attr' => ['class' => 'form-control']])
            ->add('code_cl', EntityType::class, [
                'class' => Compteur::class,
                'choice_label' => 'lib_cpt', 
                'multiple' => false,
                'expanded' => false, 
                'attr' => ['class' => 'form-control'],
            ])

            ->add('etudiant', EntityType::class, [
                'class' => EspEtudiant::class,
                'choice_label' => 'id', 
                'multiple' => false,
                'expanded' => false, 
                'attr' => ['class' => 'form-control'],
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspInscription::class,
        ]);
    }
}
