<?php

namespace App\Controller\Admin;

use App\Entity\CritereEvaluation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CritereEvaluationCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return CritereEvaluation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des critères évaluations')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un critère évaluation')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier le critère évaluation')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du critère évaluation');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextEditorField::new('description'),
            AssociationField::new('evaluation', 'Évaluation'),
        ];
    }
}
