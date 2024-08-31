<?php

namespace App\Form;

use App\Entity\EspEtudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Etudiantform1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom_et', null, [
                'label' => 'Nom Etudiant',
            ])
            ->add('pnom_et', null, [
                'label' => 'Prénom Etudiant',
            ])

            ->add('date_nais_et', null, [
                'label' => 'Date de Naissance Etudiant',
            ])
            ->add('lieu_nais_et', null, [
                'label' => 'Lieu de Naissance Etudiant',
            ])
            ->add('adresse_et', null, [
                'label' => 'Adresse Etudiant',
            ])
            ->add('tel_et', null, [
                'label' => 'Téléphone Etudiant',
            ])
            ->add('e_mail_et', null, [
                'label' => 'E-mail Etudiant',
            ])

            ->add('ville_et', null, [
                'label' => 'Ville Etudiant',
            ])
            ->add('pays_et', null, [
                'label' => 'pays Etutudiant',
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Genre Etudiant',
                'choices' => [
                    'Masculin' => 'M',
                    'Féminin' => 'F',
                ],
                'expanded' => true, // Will render as radio buttons
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspEtudiant::class,
        ]);
    }
}
