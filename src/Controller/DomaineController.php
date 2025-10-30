<?php

namespace App\Controller;

use App\Repository\DomaineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DomaineController extends AbstractController
{
    #[Route('/domaines', name: 'list_domaines')]
    public function index(DomaineRepository $repo): Response
    {
        return $this->render('domaine/list_domaines.html.twig', [
            'domaines' => $repo->findAll(),
        ]);
    }

    #[Route('/domaine/{id}', name: 'domaine_show')]
    public function showDomaine(int $id, DomaineRepository $repo): Response
    {
        $domaine = $repo->find2($id);
        if (!$domaine) {
            throw $this->createNotFoundException('Domaine non trouvé');
        }

        return $this->render('domaine/domaine.html.twig', ['domaine' => $domaine]);
    }
}
