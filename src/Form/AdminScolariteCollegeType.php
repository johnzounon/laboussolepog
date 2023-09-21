<?php

namespace App\Form;

use App\Entity\ScolariteCollege;
use App\Entity\ClasseCollege;
use App\Entity\User;
use App\Entity\Inscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class AdminScolariteCollegeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classe', EntityType::class,[
                'class' => ClasseCollege::class,
                'choice_label' => 'titre',
                'label' => false,
                'required' => true,
                'attr' => [
                'class'=> 'form-control',
                ],
                'placeholder' => 'Sélectionnez une classe'
            ])
            ->add('eleve', ChoiceType::class, [
                'placeholder' => 'Sélectionnez un élève',
                'required' => true,
                'label' => false,
                'attr' => [
                    'class'=> 'form-control',
                ]

            ])
            ->add('montant_chiffre', NumberType::class,[
                'label' => false,
                'required' => true,
                'attr' => [
                    'class'=> 'form-control',
                    'placeholder' => 'Montant en chiffres (Ex: 110000)',
                ]  
            ])
            ->add('montant_lettre', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => [
                    'class'=> 'form-control',
                    'placeholder' => 'Montant en lettres (Ex: Cent-dix mille)'
                ]  
            ])
            ->add('tarif_mensuel', NumberType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'class'=> 'form-control',
                    'placeholder' => 'Tarif par Tranche (Ex: 110000)',
                ]  
            ])
            ->add('tranche', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => [
                    'class'=> 'form-control',
                    'placeholder' => 'Ex: 1ère Tranche'
                ]  
            ])
        ;

        $formModifier = function(FormInterface $form, ClasseCollege $cycle = null){
            $classe = null === $cycle ?  [] : $cycle->getInscriptions();

            $form->add('eleve', EntityType::class, [
                
                'class' => Inscription::class,
                'choices' => $classe,
                'required' => false,
                'choice_label' => 'nom_complet',
                'attr' => [
                    'class'=> 'form-control'
                ],
                'label' => false,
                'placeholder' => 'Élèves de cette classe',
            ]);
        };

        $builder->get('classe')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($formModifier){
                $cycle = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $cycle);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ScolariteCollege::class,
        ]);
    }
}
