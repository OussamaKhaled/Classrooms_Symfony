<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KhaledOussamaController extends AbstractController
{
    #[Route('/khaled/oussama', name: 'app_khaled_oussama')]
    public function index(): Response
    {
        return $this->render('khaled_oussama/index.html.twig', [
            'controller_name' => 'KhaledOussamaController',
        ]);
    }

    #[Route('/khaled/oussama/{metier}', name: 'metier_reve')]
    public function afficheMetier($metier)
    {
    $message = 'Mon métier de rêve est : ' . $metier;
    return $this->render('khaled_oussama/affiche_metier.html.twig', [
        'message' => $message,'metier' => $metier,
        ]);
    }
}
