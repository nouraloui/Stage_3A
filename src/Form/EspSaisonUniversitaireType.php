<?php

namespace App\Form;

use App\Entity\EspSaisonUniversitaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\EspSaisonClasse;

class EspSaisonUniversitaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', null, ['attr' => ['class' => 'form-control']])
            ->add('date_debut', null, ['attr' => ['class' => 'form-control']])
            ->add('date_fin', null, ['attr' => ['class' => 'form-control']])
            ->add('observation', null, ['attr' => ['class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspSaisonUniversitaire::class,
        ]);
    }
}
