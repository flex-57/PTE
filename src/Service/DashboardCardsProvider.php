<?php

namespace App\Service;

use App\Controller\Admin\AtelierCrudController;
use App\Controller\Admin\CritereCrudController;
use App\Controller\Admin\MetierCrudController;
use App\Controller\Admin\DomaineCrudController;
use App\Controller\Admin\UserCrudController;
use App\Entity\Atelier;
use App\Entity\Critere;
use App\Entity\Domaine;
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
                'title' => 'Ateliers',
                'description' => 'Gestion des ateliers',
                'count' => $this->em->getRepository(Atelier::class)->count([]),
                'controller' => AtelierCrudController::class,
                'icon' => 'fas fa-star',
                'gradient_start' => '#ecfdf5',
                'gradient_end' => '#d1fae5',
                'badge_color' => '#10b981',
            ],
            [
                'title' => 'Critères',
                'description' => 'Gestion des critères',
                'count' => $this->em->getRepository(Critere::class)->count([]),
                'controller' => CritereCrudController::class,
                'icon' => 'fas fa-check',
                'gradient_start' => '#f3f4f6',
                'gradient_end' => '#e5e7eb',
                'badge_color' => '#6b7280',
            ],
        ];
    }
}
