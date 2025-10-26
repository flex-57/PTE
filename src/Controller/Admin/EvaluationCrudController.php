<?php

namespace App\Controller\Admin;

use App\Entity\Evaluation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class EvaluationCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evaluation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des évaluations')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une évaluation')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier l\'évaluation')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de l\'évaluation');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextareaField::new('description'),
            AssociationField::new('domaine'),
        ];
    }
}
