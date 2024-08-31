<?php

namespace App\Form;

use App\Entity\EspEtudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Etudiantform2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nationalite', null, [
                'label' => 'Nationalité Etudiant',
            ])
            ->add('tel_parent_et', null, [
                'label' => 'Téléphone du parent',
            ])
            ->add('e_mail_parent', null, [
                'label' => 'E-mail du parent',
            ])
            ->add('cp_parent')
            ->add('adresse_parent', null, [
                'label' => 'Adresse du parent',
            ])
            ->add('ville_parent', null, [
                'label' => 'Ville du parent',
            ])
            ->add('pays_parent', null, [
                'label' => 'Pays du parent',
            ])
            ->add('cp_et')
            ->add('nature_et', ChoiceType::class, [
                'label' => 'Nature',
                'choices' => [
                    'Cin' => 'cin',
                    'Passeport' => 'passeport',
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => ['class' => 'inline-radio-buttons'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspEtudiant::class,
        ]);
    }
}
