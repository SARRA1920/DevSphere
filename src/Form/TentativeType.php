<?php

namespace App\Form;

use App\Entity\Tentative;
use App\Entity\User;
use App\Entity\Exercice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TentativeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('score', NumberType::class, [
                'label' => 'Score',
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                    'class' => 'form-control'
                ]
            ])
            ->add('statue', TextType::class, [
                'label' => 'Statut',
                'attr' => ['class' => 'form-control']
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'label' => 'Utilisateur',
                'attr' => ['class' => 'form-control']
            ])
            ->add('exercice', EntityType::class, [
                'class' => Exercice::class,
                'choice_label' => 'titre',
                'label' => 'Exercice',
                'attr' => ['class' => 'form-control']
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
