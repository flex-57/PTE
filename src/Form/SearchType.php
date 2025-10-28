<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType as _SearchType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q', _SearchType::class, [
                'label' => false,
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Tapez votre recherche...',
                ],
            ]);
    }
}
