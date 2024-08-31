<?php

namespace App\Form;

use App\Entity\EspEnseignant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EspEnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_ens', TextType::class)
            ->add('nom_ens', TextType::class)
            ->add('type_ens', TextType::class)
            ->add('date_rec', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('niveau', TextType::class)
            ->add('date_saisie', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('date_dern_modif', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('etat', TextType::class)
            ->add('observation', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspEnseignant::class,
        ]);
    }
}
