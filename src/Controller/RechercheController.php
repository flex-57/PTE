<?php

namespace App\Controller;

use App\Entity\Metier;
use App\Form\RechercheType;
use App\Repository\AtelierRepository;
use App\Repository\CritereRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DomaineRepository;
use App\Repository\MetierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function search(
        Request $request,
        DomaineRepository $domaineRepo,
        MetierRepository $metierRepo,
        AtelierRepository $atelierRepo,
        CritereRepository $critereRepo
    ): Response {
        $query = trim($request->query->get('q', ''));

        if (!$query) {
            return $this->redirect($request->headers->get('referer') ?? $this->generateUrl('home'));
        }

        $categoryRepos = [
            'domaines' => $domaineRepo,
            'metiers' => $metierRepo,
            'ateliers' => $atelierRepo,
            'criteres' => $critereRepo,
        ];

        $results = [];
        foreach (RechercheType::CATEGORIES as $cat) {
            $repo = $categoryRepos[$cat];
            $results[$cat] = $request->query->get($cat) ? $repo->searchDeep($query) : [];
        }

        return $this->render('recherche/index.html.twig', [
            ...$results,
            'query' => $query,
        ]);
    }
}

