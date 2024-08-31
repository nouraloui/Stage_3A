<?php

namespace App\Form;

use App\Entity\EspModule;
use App\Entity\EspNote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EspNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_module', EntityType::class, [
                'class' => EspModule::class,
                'choice_label' => 'code_module',
                'label' => 'Module',
            ])
            ->add('codeCl', TextType::class, [
                'label' => 'Code Classe',
            ])
            ->add('AnneeDeb', TextType::class, [
                'label' => 'Année Début',
            ])
            ->add('IdEt', TextType::class, [
                'label' => 'ID Étudiant',
            ])
            ->add('NoteExam', NumberType::class, [
                'label' => 'Note d\'Examen',
                'required' => false, // Rendre le champ optionnel si nécessaire
            ])
            ->add('NoteTP', NumberType::class, [
                'label' => 'Note TP',
                'required' => false, // Rendre le champ optionnel si nécessaire
            ])
            ->add('NoteCC', NumberType::class, [
                'label' => 'Note CC',
                'required' => false, // Rendre le champ optionnel si nécessaire
            ])
            ->add('isConfirmed', CheckboxType::class, [
                'label' => 'Confirmée',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EspNote::class,
        ]);
    }
}
