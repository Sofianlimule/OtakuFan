<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UniversController extends AbstractController
{
    #[Route('/univers', name: 'app_univers')]
    public function index(): Response
    {
        return $this->render('univers/Univers.html.twig', [
            'controller_name' => 'UniversController',
        ]);
    }
}
