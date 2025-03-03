<?php

namespace App\Form;

use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z0-9\s]+$/',
                        'message' => 'The title must contain only letters and spaces.',
                    ]),
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Hackathon' => 'hackathon',
                    'Learning' => 'learning',
                    'Other' => 'other',
                ],
                'placeholder' => 'Choose an event type',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('capacity', IntegerType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Positive([
                        'message' => 'Capacity must be a positive number.',
                    ]),
                ],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThan([
                        'value' => 'today',
                        'message' => 'The event date must be in the future.',
                    ]),
                ],
            ])
            ->add('location', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Location cannot be empty.',
                    ]),
                ],
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
