<?php

namespace App\Form;

use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un titre',
                    ]),
                ],
            ])
            ->add('niveau_difficulte', ChoiceType::class, [
                'label' => 'Niveau de difficulté',
                'choices' => [
                    'Facile' => 'facile',
                    'Moyen' => 'moyen',
                    'Difficile' => 'difficile'
                ],
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un niveau de difficulté',
                    ]),
                ],
            ])
            ->add('note_minimale', NumberType::class, [
                'label' => 'Note minimale',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 20,
                    'step' => 0.5
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une note minimale',
                    ]),
                    new Range([
                        'min' => 0,
                        'max' => 20,
                        'notInRangeMessage' => 'La note doit être comprise entre {{ min }} et {{ max }}',
                    ]),
                    new Regex([
                        'pattern' => '/^\d+(\.\d{1})?$/',
                        'message' => 'La note doit être un nombre avec au maximum une décimale',
                    ])
                ],
                'html5' => true,
                'scale' => 1,
            ])
            ->add('temps_estime', IntegerType::class, [
                'label' => 'Temps estimé (en minutes)',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 480
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un temps estimé',
                    ]),
                    new Range([
                        'min' => 1,
                        'max' => 480,
                        'notInRangeMessage' => 'Le temps doit être compris entre {{ min }} et {{ max }} minutes',
                    ]),
                    new Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Le temps doit être un nombre entier',
                    ])
                ],
            ])
            ->add('fichier_pdf', FileType::class, [
                'label' => 'Fichier PDF',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un document PDF valide',
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'accept' => 'application/pdf'
                ],
                'help' => 'Format accepté : PDF. Taille maximale : 5MB'
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'choices' => [
                    'Quiz' => 'quiz',
                    'Exercice pratique' => 'pratique',
                    'Devoir' => 'devoir'
                ],
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un type d\'exercice',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
}
