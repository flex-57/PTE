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
                    'aria-label' => 'Recherche',
                    'class' => 'w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500',
                    
                ],
            ]);
    }
}
