<?php

namespace App\Form;

use App\Entity\Exercice;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

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
                        'message' => 'Le titre est obligatoire',
                    ]),
                ],
            ])
            ->add('niveauDifficulte', ChoiceType::class, [
                'label' => 'Niveau de difficulté',
                'choices' => [
                    'Facile' => 'facile',
                    'Moyen' => 'moyen',
                    'Difficile' => 'difficile'
                ],
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le niveau de difficulté est obligatoire',
                    ]),
                ],
            ])
            ->add('noteMinimale', NumberType::class, [
                'label' => 'Note minimale',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 20,
                    'step' => 0.5
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'La note minimale est obligatoire',
                    ]),
                    new Range([
                        'min' => 0,
                        'max' => 20,
                        'notInRangeMessage' => 'La note doit être comprise entre {{ min }} et {{ max }}',
                    ]),
                ],
            ])
            ->add('tempsEstime', IntegerType::class, [
                'label' => 'Temps estimé (en minutes)',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 480
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le temps estimé est obligatoire',
                    ]),
                    new Range([
                        'min' => 1,
                        'max' => 480,
                        'notInRangeMessage' => 'Le temps estimé doit être compris entre {{ min }} et {{ max }} minutes',
                    ]),
                ],
            ])
            ->add('type_exercice', ChoiceType::class, [
                'label' => 'Type d\'exercice',
                'choices' => [
                    'QCM' => 'qcm',
                    'Code HTML' => 'html',
                    'Code JavaScript' => 'javascript',
                    'Code PHP' => 'php',
                    'Texte libre' => 'text',
                    'Vrai/Faux' => 'true_false'
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type d\'exercice',
                'choices' => [
                    'Quiz' => 'quiz',
                    'Pratique' => 'pratique',
                    'Devoir' => 'devoir'
                ],
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le type est obligatoire',
                    ]),
                ],
            ])
            ->add('solution', TextareaType::class, [
                'label' => 'Solution',
                'attr' => [
                    'class' => 'form-control code-editor',
                    'rows' => 10,
                    'placeholder' => 'Entrez la solution de référence ici...'
                ]
            ])
            ->add('criteres_evaluation', TextareaType::class, [
                'label' => 'Critères d\'évaluation',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 5,
                    'placeholder' => 'Entrez les critères d\'évaluation séparés par des virgules...'
                ]
            ])
            ->add('fichier_pdf', FileType::class, [
                'label' => 'Fichier PDF',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'form-control'],
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
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user) {
                    return $user->getName() . ' (' . $user->getEmail() . ')';
                },
                'label' => 'Créé par',
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Sélectionnez un utilisateur',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner un utilisateur',
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
