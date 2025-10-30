<?php

namespace App\Controller;

use App\Repository\MetierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MetierController extends AbstractController
{
    #[Route('/metiers', name: 'list_metiers')]
    public function index(MetierRepository $repo): Response
    {
        return $this->render('metier/list_metiers.html.twig', [
            'metiers' => $repo->findAll(),
        ]);
    }

    #[Route('/metier/{id}', name: 'metier_show')]
    public function showMetier(int $id, MetierRepository $repo): Response
    {
        $metier = $repo->find2($id);

        if (!$metier) {
            throw $this->createNotFoundException('Métier non trouvé');
        }

        return $this->render('metier/metier.html.twig', ['metier' => $metier]);
    }
}
