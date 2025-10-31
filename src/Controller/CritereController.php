<?php

namespace App\Controller;

use App\Repository\CritereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CritereController extends AbstractController
{
    #[Route('/criteres', name: 'list_criteres')]
    public function index(CritereRepository $repo): Response
    {
        return $this->render('critere/list_criteres.html.twig', [
            'criteres' => $repo->findAll(),
        ]);
    }

    #[Route('/critere/{id}', name: 'critere_show')]
    public function showCritere(int $id, CritereRepository $repo): Response
    {
        $critere = $repo->find2($id);

        if (!$critere) {
            throw $this->createNotFoundException('Critère non trouvé');
        }

        return $this->render('critere/critere.html.twig', ['critere' => $critere]);
    }
}
