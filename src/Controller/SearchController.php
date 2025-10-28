<?php

namespace App\Controller;

use App\Entity\Metier;
use App\Repository\AtelierRepository;
use App\Repository\CritereRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DomaineRepository;
use App\Repository\MetierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function search(
        Request $request, 
        DomaineRepository $domaineRepo,
        MetierRepository $metierRepo,
        AtelierRepository $atelierRepo,
        CritereRepository $critereRepo
    ): Response
    {
        $query = $request->query->get('q', null);

        if ($query) {
            
                $domaines = $domaineRepo->searchDeep($query);
                $metiers = $metierRepo->searchDeep($query);
                $ateliers = $atelierRepo->searchDeep($query);
                $criteres = $critereRepo->searchDeep($query);
            
        }

        return $this->render('home/search.html.twig', [
            'domaines' => $domaines, 
            'metiers' => $metiers, 
            'ateliers' => $ateliers, 
            'criteres' => $criteres,
        ]);
    }
}