<?php

/*namespace App\Form;

use App\Entity\Compteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_cpt')
            ->add('lib_cpt')
            ->add('date_cr')
            ->add('date_last_modif')
            ->add('taille')
            ->add('valeur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compteur::class,
        ]);
    }
}
*/










// src/Form/CompteurType.php
namespace App\Form;

use App\Entity\Compteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CompteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeCpt', TextType::class)
            ->add('libCpt', TextType::class)
            ->add('dateCr', DateType::class, ['widget' => 'single_text'])
            ->add('dateLastModif', DateType::class, ['widget' => 'single_text'])
            ->add('taille', IntegerType::class)
            ->add('valeur', IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compteur::class,
        ]);
    }
}
