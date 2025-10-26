<?php

namespace App\Controller\Admin;

use App\Entity\CritereEvaluation;
use App\Entity\CritereMetier;
use App\Entity\Domaine;
use App\Entity\Evaluation;
use App\Entity\Metier;
use App\Entity\User;
use App\Service\DashboardCardsProvider;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard as AttributeAdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Component\HttpFoundation\Response;

#[AttributeAdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(private DashboardCardsProvider $cardsProvider) {}

    public function index(): Response
    {
        $cards = $this->cardsProvider->getCards();

        return $this->render('admin/dashboard.html.twig', compact('cards'));
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()->setTitle('EPT Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToUrl('Retour au site', 'fa fa-arrow-left', '/');

        yield MenuItem::section('Gestion');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Domaines', 'fas fa-list', Domaine::class);
        yield MenuItem::linkToCrud('Métiers', 'fas fa-briefcase', Metier::class);
        yield MenuItem::linkToCrud('Critères métiers', 'fas fa-check', CritereMetier::class);
        yield MenuItem::linkToCrud('Évaluations', 'fas fa-star', Evaluation::class);
        yield MenuItem::linkToCrud('Critères évaluations', 'fas fa-check-circle', CritereEvaluation::class);
    }
}
