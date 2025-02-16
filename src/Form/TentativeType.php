<?php

namespace App\Form;

use App\Entity\Tentative;
use App\Entity\Exercice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class TentativeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('score', IntegerType::class, [
                'label' => 'Score',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 20
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un score',
                    ]),
                    new Range([
                        'min' => 0,
                        'max' => 20,
                        'notInRangeMessage' => 'Le score doit être compris entre {{ min }} et {{ max }}',
                    ]),
                ],
            ])
            ->add('statue', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'En cours' => 'en_cours',
                    'Terminé' => 'termine',
                    'Abandonné' => 'abandonne'
                ],
                'attr' => ['class' => 'form-select'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un statut',
                    ]),
                ],
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner une date',
                    ]),
                ],
            ])
            ->add('exercice', EntityType::class, [
                'class' => Exercice::class,
                'choice_label' => 'titre',
                'label' => 'Exercice',
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Sélectionnez un exercice',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner un exercice',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tentative::class,
        ]);
    }
}
