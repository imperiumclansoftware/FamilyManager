<?php

namespace App\Form\Type\banque;
use App\Entity\banque\Banque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BanqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etablissement')
            ->add('logo')
            ->add('adresseBanque')
            ->add('typeCompte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Banque::class,
        ]);
    }
}
