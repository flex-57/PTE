<?php

namespace App\Controller\Admin;

use App\Entity\Metier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class MetierCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Metier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des métiers')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un métier')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier le métier')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du métier');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('description'),
            AssociationField::new('domaine')->setRequired(true),
            AssociationField::new('criteres'),
        ];
    }
}
