<?php

namespace App\Form\Type\banque;

use App\Entity\banque\Chequier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChequierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chequier')
            ->add('dateChequier')
            ->add('debutNum')
            ->add('finNum')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chequier::class,
        ]);
    }
}
