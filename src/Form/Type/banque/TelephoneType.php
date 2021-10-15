<?php

namespace App\Form\Type\banque;

use App\Entity\banque\Telephone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TelephoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephoneDetenteur1')
            ->add('telephoneDetenteur2')
            ->add('telephonePro1')
            ->add('telephonePro2')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Telephone::class,
        ]);
    }
}
