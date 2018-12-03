<?php

namespace App\Form\Type;


use App\Entity\Exercice;
use App\Entity\Serie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('exercice', EntityType::class, [
                'class' => Exercice::class,
                'choice_label' => 'name',
                'required' => true,
                'label' => 'Exercice',
            ])
            ->add('charge', NumberType::class, [
                'required' => true,
                'scale' => 2,
                'label' => 'Charge (kg)',
                'attr' => array(
                    'min' => 1,
                    'step' => 0.5,
                ),
            ])
            ->add('repetition', IntegerType::class, [
                'required' => true,
                'attr' => array(
                    'min' => 1,
                ),
            ])
            ->add('repos', IntegerType::class, [
                'required' => true,
                'attr' => array(
                    'min' => 0,
                ),
                'label' => 'Repos (en secondes)',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::Class,
        ]);
    }
}