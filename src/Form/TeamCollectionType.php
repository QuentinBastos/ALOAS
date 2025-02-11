<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\TeamMatchResult;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $teams = $options['teams'];
        $builder
            ->add('teams', CollectionType::class, [
                'entry_type' => TeamType::class,
                'entry_options' => ['label' => false, 'teams' => $teams],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'attr' => [
                    'class' => 'team-collection',
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'teams' => null,
        ]);
    }
}
