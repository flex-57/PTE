<?php

namespace App\Controller\Admin;

use App\Entity\Critere;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CritereCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Critere::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des critères')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un critère')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier le critère')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du critère');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('description'),
            AssociationField::new('metiers', 'Métier'),
            AssociationField::new('ateliers', 'Atelier'),
        ];
    }
}
