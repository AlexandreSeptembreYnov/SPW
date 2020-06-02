<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('superficie')
            ->add('nb_pieces')
            ->add('type')
            ->add('description')
            ->add('jardin')
            ->add('cave')
            ->add('ceillier')
            ->add('loggia')
            ->add('terrasse')
            ->add('garage')
            ->add('verranda')
            ->add('prix_min')
            ->add('address')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
