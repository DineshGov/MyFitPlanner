<?php

namespace App\Form\Type;


use App\Entity\Exercice;
use App\Entity\GroupeMusculaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciceType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description (facultative)'
            ])
            ->add('groupesMusculaires', EntityType::class, [
                'required' => true,
                'class' => GroupeMusculaire::class,
                'choice_label' => 'name',
                'label' => 'Groupe musculaire',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exercice::Class,
        ]);
    }
}

