<?php

namespace App\Form;

use App\Entity\EspSaisonClasse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\EspSaisonUniversitaire;

class EspSaisonClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_demarrage', null, ['attr' => ['class' => 'form-control']])
            ->add('annee_deb', null, ['attr' => ['class' => 'form-control']])
            ->add('description', null, ['attr' => ['class' => 'form-control']])
            ->add('code_cl', null, ['attr' => ['class' => 'form-control']])
            ->add('nb_etudiant', null, ['attr' => ['class' => 'form-control']])
            ->add('salle_principale', null, ['attr' => ['class' => 'form-control']])
            ->add('salle_secondaire_1', null, ['attr' => ['class' => 'form-control']])
            ->add('salle_secondaire_2', null, ['attr' => ['class' => 'form-control']])
            ->add('nature', null, ['attr' => ['class' => 'form-control']])
            ->add('type_classe', null, ['attr' => ['class' => 'form-control']])
            ->add('nb_seance', null, ['attr' => ['class' => 'form-control']])
            ->add('classe_entreprise', null, ['attr' => ['class' => 'form-control']])
            ->add('semestre', null, ['attr' => ['class' => 'form-control']])
            ->add('cl_eclate', null, ['attr' => ['class' => 'form-control']])
            ->add('espSaisonUniversitaire', EntityType::class, [
                'class' => EspSaisonUniversitaire::class,
                'choice_label' => 'description', 
                'multiple' => false,
                'expanded' => false, 
                'attr' => ['class' => 'form-control'],
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspSaisonClasse::class,
        ]);
    }
}
