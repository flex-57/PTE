<?php

namespace App\Service;

use App\Controller\Admin\UserCrudController;
use App\Controller\Admin\DomaineCrudController;
use App\Controller\Admin\MetierCrudController;
use App\Controller\Admin\EvaluationCrudController;
use App\Controller\Admin\CritereMetierCrudController;
use App\Controller\Admin\CritereEvaluationCrudController;
use App\Entity\CritereEvaluation;
use App\Entity\CritereMetier;
use App\Entity\Domaine;
use App\Entity\Evaluation;
use App\Entity\Metier;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class DashboardCardsProvider
{
    public function __construct(private EntityManagerInterface $em) {}

    public function getCards(): array
    {
        return [
            [
                'title' => 'Utilisateurs',
                'description' => 'Gestion des utilisateurs',
                'count' => $this->em->getRepository(User::class)->count([]),
                'controller' => UserCrudController::class,
                'icon' => 'fas fa-user',
                'gradient_start' => '#dbeafe',
                'gradient_end' => '#bfdbfe',
                'badge_color' => '#0ea5e9',
            ],
            [
                'title' => 'Domaines',
                'description' => 'Gestion des domaines et leurs caractéristiques',
                'count' => $this->em->getRepository(Domaine::class)->count([]),
                'controller' => DomaineCrudController::class,
                'icon' => 'fas fa-list',
                'gradient_start' => '#fef3c7',
                'gradient_end' => '#fde68a',
                'badge_color' => '#f59e0b',
            ],
            [
                'title' => 'Métiers',
                'description' => 'Gestion des métiers et leurs spécificités',
                'count' => $this->em->getRepository(Metier::class)->count([]),
                'controller' => MetierCrudController::class,
                'icon' => 'fas fa-briefcase',
                'gradient_start' => '#fef2f2',
                'gradient_end' => '#fecaca',
                'badge_color' => '#ef4444',
            ],
            [
                'title' => 'Évaluations',
                'description' => 'Gestion des évaluations',
                'count' => $this->em->getRepository(Evaluation::class)->count([]),
                'controller' => EvaluationCrudController::class,
                'icon' => 'fas fa-star',
                'gradient_start' => '#ecfdf5',
                'gradient_end' => '#d1fae5',
                'badge_color' => '#10b981',
            ],
            [
                'title' => 'Critères Métiers',
                'description' => 'Gestion des critères métiers',
                'count' => $this->em->getRepository(CritereMetier::class)->count([]),
                'controller' => CritereMetierCrudController::class,
                'icon' => 'fas fa-check',
                'gradient_start' => '#f3f4f6',
                'gradient_end' => '#e5e7eb',
                'badge_color' => '#6b7280',
            ],
            [
                'title' => 'Critères Évaluations',
                'description' => 'Gestion des critères d\'évaluation',
                'count' => $this->em->getRepository(CritereEvaluation::class)->count([]),
                'controller' => CritereEvaluationCrudController::class,
                'icon' => 'fas fa-check-circle',
                'gradient_start' => '#ede9fe',
                'gradient_end' => '#ddd6fe',
                'badge_color' => '#7c3aed',
            ],
        ];
    }
}
