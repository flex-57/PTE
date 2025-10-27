<?php

namespace App\Controller;

use App\Repository\CritereRepository;
use App\Repository\DomaineRepository;
use App\Repository\AtelierRepository;
use App\Repository\MetierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(DomaineRepository $repo): Response
    {
        $domaines = $repo->findAll();

        return $this->render('home/index.html.twig', ['domaines' => $domaines]);
    }

    #[Route('/domaine/{id}', name: 'domaine_show')]
    public function showDomaine($id, DomaineRepository $repo): Response
    {
        $domaine = $repo->find($id);
        if (!$domaine) {
            throw $this->createNotFoundException('Domaine non trouvé');
        }

        return $this->render('home/domaine.html.twig', ['domaine' => $domaine]);
    }

    #[Route('/metier/{id}', name: 'metier_show')]
    public function showMetier($id, MetierRepository $repo): Response
    {
        $metier = $repo->find($id);

        if (!$metier) {
            throw $this->createNotFoundException('Métier non trouvé');
        }

        return $this->render('home/metier.html.twig', ['metier' => $metier]);
    }

    #[Route('/atelier/{id}', name: 'atelier_show')]
    public function showAtelier($id, AtelierRepository $repo): Response
    {
        $atelier = $repo->find($id);
        if (!$atelier) {
            throw $this->createNotFoundException('Atelier non trouvé');
        }

        return $this->render('home/atelier.html.twig', ['atelier' => $atelier]);
    }

    #[Route('/critere/{id}', name: 'critere_show')]
    public function showCritere($id, CritereRepository $repo): Response
    {
        $critere = $repo->find($id);

        if (!$critere) {
            throw $this->createNotFoundException('Critère non trouvé');
        }

        return $this->render('home/critere.html.twig', ['critere' => $critere]);
    }
}
