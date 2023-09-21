<?php

namespace App\Form;

use App\Entity\ClassePrimaire;
use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReinscriptionPrimaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class,[
            'label' => false,
            'required' => true,
            'attr' => [
                'placeholder' => 'Entrez le nom',
                'class' => 'form-control'
                ]
            ])
        ->add('prenom', TextType::class,[
            'label' => false,
            'required' => true,
            'attr' => [
                'placeholder' => 'Entrez le(s) prénom(s)',
                'class' => 'form-control'
                ]
            ])
        ->add('classe_primaire', EntityType::class,[
            'class' => ClassePrimaire::class,
            'choice_label' => 'titre',
            'label' => false,
            'required' => true,
            'attr' => [
            'class'=> 'form-control',
            ],
            'placeholder' => 'Sélectionnez une classe'
        ])
        ->add('tuteur', TextType::class,[
            'label' => false,
            'required' => true,
            'attr' => [
                'placeholder' => 'Nom du tuteur (Ex: Mr X, Mme Y)',
                'class' => 'form-control'
                ]
            ])
        ->add('telephone', TelType::class,[
            'label' => false,
            'required' => true,
            'attr' => [
                'placeholder' => 'Ex: 077XXXXXX',
                'class' => 'form-control'
                ]
            ])
        ->add('avec_ram', ChoiceType::class,[
            'label' => false,
            'required' => true,
            'choices' =>  [
                    'Oui' => true,
                    'Non' => false
            ],
            'expanded' => true,
            'attr' => [
                'class' => 'form-control'
                ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
