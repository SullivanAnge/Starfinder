<?php

namespace App\Form;

use App\Entity\Arme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArmeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('prix')
            ->add('degats')
            ->add('TypeDegat')
            ->add('portee')
            ->add('critque')
            ->add('capacite')
            ->add('consomation')
            ->add('volume')
            ->add('special')
            ->add('main')
            ->add('categorie')
            ->add('niveau')
            ->add('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Arme::class,
        ]);
    }
}
