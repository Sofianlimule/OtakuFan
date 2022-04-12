<?php

namespace App\Controller;

use App\Entity\Personnages;
use App\Form\CreatePersonnageType;
use App\Repository\PersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PersonnagesRepository $personnagesRepository): Response
    {
        $personnages = $personnagesRepository->findAll();
        return $this->render('home/index.html.twig', ['personnages' => $personnages]);
    }
}
