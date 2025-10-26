<?php

namespace App\Controller\Admin;

use App\Entity\Domaine;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class DomaineCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Domaine::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des domaines')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un domaine')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier le domaine')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du domaine');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('description'),
            AssociationField::new('metiers', 'Métiers')->hideOnForm(),
        ];
    }
}
