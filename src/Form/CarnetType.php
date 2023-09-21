<?php

namespace App\Form;

use App\Entity\Carnet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarnetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('groupe', ChoiceType::class,[
                'label' => false,
                'required' => true,
                'choices' =>  [
                    'Inscription Primaire' => 'ISP',
                    'Inscription Collège' => 'ISC',
                    'Réinscription Primaire' => 'RSP',
                    'Scolarité Primaire' => 'SCP',
                    'Scolarité Collège' => 'SCC',
                    'Arriérés Primaire' => 'ARP',
                    'Arriérés Collège' => 'ARC',
                    'Carnet Tenue' => 'CTN',
                ],
                'attr' => [
                    'class' => 'form-control'
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carnet::class,
        ]);
    }
}
