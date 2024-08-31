<?php

namespace App\Form;

use App\Entity\CodeNomenclature;
use App\Entity\EspEtudiant;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Etudiantform3Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


            ->add('fonction_et')
            ->add('cycle_et', EntityType::class, [
                'class' => CodeNomenclature::class,
                'choice_label' => 'libNome',
                'choice_value' => 'codeNome',
                'placeholder' => 'sélectionner un cycle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.code_str = :code_str')
                        ->setParameter('code_str', 01);  // Set default or conditionally set based on logic
                },
            ])
            ->add('nature_bac', EntityType::class, [
                'class' => CodeNomenclature::class,
                'choice_label' => 'libNome',
                'choice_value' => 'codeNome',
                'placeholder' => 'sélectionner nature ',
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.code_str = :code_str')
                        ->setParameter('code_str', 02);  // Set default or conditionally set based on logic
                },
            ])
            ->add('date_bac')
            ->add('num_bac_et')
            ->add('etab_bac')
            ->add('diplome_sup_et')
            ->add('niveau_diplome_sup_et')
            ->add('etab_origine', EntityType::class, [
                'class' => CodeNomenclature::class,
                'choice_label' => 'libNome',
                'label' => 'Etablissement d`origine',
                'choice_value' => 'codeNome',
                'placeholder' => 'sélectionner établissement ',
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.code_str = :code_str')
                        ->setParameter('code_str', 04);  // Set default or conditionally set based on logic
                },
            ])
           
            ->add('nature_cours');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspEtudiant::class,
        ]);
    }
}
