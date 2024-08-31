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

class Etudiantform4Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('speialite_esp_et', EntityType::class, [
                'class' => CodeNomenclature::class,
                'choice_label' => 'libNome',
                'label' => 'Spécialité à réaliser',
                'choice_value' => 'codeNome',
                'placeholder' => 'sélectionner spécialité ',
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.code_str = :code_str')
                        ->setParameter('code_str', 03);  // Set default or conditionally set based on logic
                },
            ])

            ->add('classe_courante_et')
            ->add('resultat_final_et')
            ->add('diplome_obtenu_esp_et')
            ->add('moyenne_dern_semestre_et')
            ->add('date_sortie_et')
            ->add('nature_piece_id')
            ->add('observation_et')
            ->add('date_saisie')
            ->add('date_dern_modif')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspEtudiant::class,
        ]);
    }
}
