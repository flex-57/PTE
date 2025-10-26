<?php

namespace App\Controller\Admin;

use App\Entity\CritereMetier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CritereMetierCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return CritereMetier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des critères métier')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un critère métier')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier le critère métier')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du critère métier');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('description'),
            AssociationField::new('metier', 'Métier'),
        ];
    }
}
