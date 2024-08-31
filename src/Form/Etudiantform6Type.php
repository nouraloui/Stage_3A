<?php

namespace App\Form;

use App\Entity\EspEtudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Etudiantform6Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('agent')
            ->add('num_ord')
            ->add('date_delivrance')
            ->add('lieu_delivrance')
            ->add('situation_financiere_et')
        
            ->add('niveau_acces', ChoiceType::class, [
                'label' => 'Niveau Accées Étudiant',
                'choices' => [
                    '1ère' => '1',
                    '2ème' => '2',
                    '3ème' => '3',
                    '4ème' => '4',
                    '5ème' => '5',
                    'Cs' => '6',
                    'Fc' => '7',
                    'Ep1' => '8',
                    'Ep2' => '9',

                ],
                'expanded' => true, // Render as radio buttons
                'multiple' => false, // Single choice
                'attr' => ['class' => 'inline-radio-buttons'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspEtudiant::class,
        ]);
    }
}
