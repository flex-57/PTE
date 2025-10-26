<?php

namespace App\Controller;

use App\Repository\CritereEvaluationRepository;
use App\Repository\CritereMetierRepository;
use App\Repository\DomaineRepository;
use App\Repository\EvaluationRepository;
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

    #[Route('/critere-metier/{id}', name: 'critere_metier_show')]
    public function showCritereMetier($id, CritereMetierRepository $repo): Response
    {
        $critereMetier = $repo->find($id);

        if (!$critereMetier) {
            throw $this->createNotFoundException('Critère métier non trouvé');
        }

        return $this->render('home/critere_metier.html.twig', ['critere_metier' => $critereMetier]);
    }

    #[Route('/evaluation/{id}', name: 'evaluation_show')]
    public function showEvaluation($id, EvaluationRepository $repo): Response
    {
        $evaluation = $repo->find($id);
        if (!$evaluation) {
            throw $this->createNotFoundException('Évaluation non trouvée');
        }

        return $this->render('home/evaluation.html.twig', ['evaluation' => $evaluation]);
    }

    #[Route('/critere-evaluation/{id}', name: 'critere_evaluation_show')]
    public function showCritereEvaluation($id, CritereEvaluationRepository $repo): Response
    {
        $critereEvaluation = $repo->find($id);

        if (!$critereEvaluation) {
            throw $this->createNotFoundException('Critère évaluation non trouvé');
        }

        return $this->render('home/critere_evaluation.html.twig', ['critere_evaluation' => $critereEvaluation]);
    }
}
