<?php

namespace App\Form;

use App\Entity\Personnages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('occupation')
            ->add('ranksCultivations')
            ->add('Alias')
            ->add('Status')
            ->add('Genre')
            ->add('Race')
            ->add('proches')
            ->add('amis')
            ->add('ennemies')
            ->add('profession')
            ->add('premierApparition')
            ->add('skills')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnages::class,
        ]);
    }
}
