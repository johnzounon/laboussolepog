<?php

namespace App\Form;

use App\Entity\AnneeAcademique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class AnneeAcademiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_debut', IntegerType::class,[
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Début (Ex: 2023)',
                    'class' => 'form-control'
                    ]
                ])
            ->add('date_fin', IntegerType::class,[
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Fin (Ex: 2024)',
                    'class' => 'form-control'
                    ]
                ])
            ->add('annee_encours', ChoiceType::class,[
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
            'data_class' => AnneeAcademique::class,
        ]);
    }
}
