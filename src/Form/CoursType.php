<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\CategorieCours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre du cours'
            ])
            ->add('description', TextType::class, [
                'label' => 'Description'
            ])
            ->add('niveau', TextType::class, [
                'label' => 'Niveau'
            ])
            ->add('duree', TextType::class, [
                'label' => 'Durée'
            ])
            ->add('categorieCours', EntityType::class, [
                'class' => CategorieCours::class,
                'choice_label' => 'nom',
                'label' => 'Catégorie'
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
