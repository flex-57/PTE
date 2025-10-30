<?php

namespace App\Controller\Admin;

use App\Entity\Atelier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class AtelierCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Atelier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des ateliers')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un atelier')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier l\’atelier')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de l’atelier');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('description'),
            AssociationField::new('domaine')->setRequired(true),
        ];
    }
}
