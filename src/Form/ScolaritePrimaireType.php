<?php

namespace App\Form;

use App\Entity\ClassePrimaire;
use App\Entity\Inscription;
use App\Entity\ScolaritePrimaire;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ScolaritePrimaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classe', EntityType::class,[
                'class' => ClassePrimaire::class,
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
                    'placeholder' => 'Montant en chiffres (Ex: 10000)',
                ]  
            ])
            ->add('montant_lettre', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => [
                    'class'=> 'form-control',
                    'placeholder' => 'Montant en lettres (Ex: Dix mille)'
                ]  
            ])
            ->add('tarif_mensuel', NumberType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'class'=> 'form-control',
                    'placeholder' => 'Tarif mensuel (Ex: 10000)',
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
            ->add('agent', EntityType::class,[
                'class' => User::class,
                'choice_label' => 'email',
                'label' => false,
                'required' => true,
                'attr' => [
                'class'=> 'form-control',
                ],
                'placeholder' => 'Sélectionnez un agent'
            ])
            ->add('date', DateType::class,[
                'label' => false,
                'required' => true,
                'widget' => 'single_text',
                'attr' => [
                'class'=>"form-control"
                ]
    
            ])
        ;

        $formModifier = function(FormInterface $form, ClassePrimaire $cycle = null){
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
            'data_class' => ScolaritePrimaire::class,
        ]);
    }
}
