<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Pub;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('image')
            ->add('category', EntityType::class,[
                    'class' => Category::class,
                    'choice_label' => 'Titre',

            ])
           // ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pub::class,
        ]);
    }
}
