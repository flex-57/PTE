<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SearchType as _SearchType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
    public const CATEGORIES = ['domaines', 'metiers', 'ateliers', 'criteres'];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q', _SearchType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher...',
                    'aria-label' => 'Recherche',

                ],
            ]);

        foreach (self::CATEGORIES as $category) {
            $builder->add($category, CheckboxType::class, [
                'label' => mb_ucfirst($category),
                'required' => false,
                'attr' => [
                    'aria-label' => 'Inclure les ' . $category . ' dans la recherche',
                ]
            ]);
        }
    }
}
