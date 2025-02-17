<?php

namespace App\Form;

use App\Entity\Publication;
use App\Entity\CategoriePublication;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Title',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter the title of your post'
                ]
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Content',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 5,
                    'placeholder' => 'Write your post content here'
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => CategoriePublication::class,
                'choice_label' => function(CategoriePublication $category) {
                    return $category->getCategory()->value;
                },
                'label' => 'Category',
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
        ]);
    }
}
