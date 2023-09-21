<?php

namespace App\Form;

use App\Entity\Tenue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TenueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant_chiffre')
            ->add('montant_lettre')
            ->add('tenue')
            ->add('livraison')
            ->add('date')
            ->add('classe_primaire')
            ->add('classe_college')
            ->add('eleve')
            ->add('agent')
            ->add('carnet')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tenue::class,
        ]);
    }
}
