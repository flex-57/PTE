<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AtelierController extends AbstractController
{
    #[Route('/ateliers', name: 'list_ateliers')]
    public function index(AtelierRepository $repo): Response
    {
        return $this->render('atelier/list_ateliers.html.twig', [
            'ateliers' => $repo->findAll(),
        ]);
    }

    #[Route('/atelier/{id}', name: 'atelier_show')]
    public function showAtelier(int $id, AtelierRepository $repo): Response
    {
        $atelier = $repo->find2($id);
        if (!$atelier) {
            throw $this->createNotFoundException('Atelier non trouvé');
        }

        return $this->render('atelier/atelier.html.twig', ['atelier' => $atelier]);
    }
}
