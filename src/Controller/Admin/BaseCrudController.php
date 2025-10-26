<?php
// src/Controller/Admin/BaseCrudController.php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

abstract class BaseCrudController extends AbstractCrudController
{
    public function configureActions(Actions $actions): Actions
    {
        $goBack = Action::new('back', 'Retour à la liste')
            ->setIcon('fa fa-arrow-left')
            ->linkToCrudAction(Crud::PAGE_INDEX)
            ->setCssClass('btn btn-secondary');

        return $actions
            // === PAGE INDEX ===
            ->remove(Crud::PAGE_DETAIL, Action::INDEX)
            ->add(Crud::PAGE_INDEX, Action::new('backToDashboard', 'Retour au dashboard')
                ->setIcon('fa fa-arrow-left')
                ->linkToUrl('/admin')
                ->setCssClass('btn btn-secondary')
                ->createAsGlobalAction())
            ->update(Crud::PAGE_INDEX, Action::NEW, fn($a) =>
                $a->setLabel('Ajouter')->setIcon('fas fa-plus')->setCssClass('btn btn-success'))
            ->update(Crud::PAGE_INDEX, Action::EDIT, fn($a) =>
                $a->setLabel('Modifier')->setIcon('fas fa-edit'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn($a) =>
                $a->setLabel('Supprimer')->setIcon('fas fa-trash'))

            // === PAGE DETAIL ===
            ->add(Crud::PAGE_DETAIL, $goBack)
            ->update(Crud::PAGE_DETAIL, Action::EDIT, fn($a) =>
                $a->setLabel('Modifier')->setIcon('fas fa-edit'))
            ->update(Crud::PAGE_DETAIL, Action::DELETE, fn($a) =>
                $a->setLabel('Supprimer')->setIcon('fas fa-trash')->setCssClass('btn btn-danger border-danger'))

            // === PAGE NEW ===
            ->add(Crud::PAGE_NEW, $goBack)
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn($a) =>
                $a->setLabel('Enregistrer')->setIcon('fas fa-check')->setCssClass('btn btn-success'))

            // === PAGE EDIT ===
            ->add(Crud::PAGE_EDIT, $goBack)
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn($a) =>
                $a->setLabel('Enregistrer')->setIcon('fas fa-check')->setCssClass('btn btn-success'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn($a) =>
                $a->setLabel('Enregistrer et continuer')->setIcon('fas fa-edit')->setCssClass('btn btn-secondary'));
    }
}
