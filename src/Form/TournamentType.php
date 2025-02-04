<?php

// src/Form/TournamentType.php

namespace App\Form;

use App\Entity\Sport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du tournoi',
                'required' => true,
                'attr' => [
                    'class' => 'w-full ',
                    'placeholder' => 'Tournoi',
                ],
                'label_attr' => [
                    'class' => 'text-sm'
                ]
            ])
            ->add('location', TextType::class, [
                'label' => 'Lieu du tournoi',
                'required' => true,
                'attr' => [
                    'class' => 'w-full ',
                    'placeholder' => 'Tournoi',
                ],
                'label_attr' => [
                    'class' => 'text-sm'
                ]
            ])
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'choice_label' => 'name',
                'label' => 'Sport',
                'placeholder' => 'Sélectionnez un sport',
                'required' => true,
                'attr' => [
                    'class' => 'w-full ',
                ],
                'label_attr' => [
                    'class' => 'text-sm'
                ]
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date',
                'required' => true,
                'attr' => [
                    'class' => 'w-full ',
                    'placeholder' => 'Choisissez une date',
                ],
                'label_attr' => [
                    'class' => 'text-sm'
                ]
            ])
            ->add('send',SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'hidden'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}

