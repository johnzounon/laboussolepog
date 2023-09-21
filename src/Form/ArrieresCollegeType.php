<?php

namespace App\Form;

use App\Entity\ArrieresCollege;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArrieresCollegeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant_chiffre')
            ->add('montant_lettre')
            ->add('tranche')
            ->add('date')
            ->add('classe')
            ->add('eleve')
            ->add('agent')
            ->add('carnet')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArrieresCollege::class,
        ]);
    }
}
