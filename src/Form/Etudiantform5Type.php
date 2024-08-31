<?php

namespace App\Form;

use App\Entity\EspEtudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class Etudiantform5Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('num_cin_passeport')
            ->add('photo_et', FileType::class, [
                'label' => 'Photo',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        // 'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid JPEG or PNG image',
                    ])
                ],
            ])
            ->add('id_et', null, [
                'label' => 'Identifiant',
            ])

            ->add('date_entree_esp_et')
            ->add('annee_entree_esp_et')
         

            ->add('niveau_courant_et', ChoiceType::class, [
                'label' => 'Niveau Courant Étudiant',
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
                'attr' => ['class' => 'inline-radio-buttons'], // Add custom class
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspEtudiant::class,
        ]);
    }
}
