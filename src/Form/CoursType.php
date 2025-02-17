<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\CategorieCours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a title',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['rows' => 4],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a description',
                    ]),
                ],
            ])
            ->add('duree', TextType::class, [
                'label' => 'Durée',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter the duration',
                    ]),
                ],
            ])
            ->add('niveau', TextType::class, [
                'label' => 'Niveau',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter the level',
                    ]),
                ],
            ])
            ->add('instructeur', TextType::class, [
                'label' => 'Instructeur',
                'required' => false,
            ])
            ->add('categorieCours', EntityType::class, [
                'class' => CategorieCours::class,
                'choice_label' => 'nom',
                'label' => 'Catégorie',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please select a category',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
