<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\PouvoirsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PouvoirsController extends AbstractController
{
    #[Route('/pouvoirs', name: 'app_pouvoirs')]
    public function index(PouvoirsRepository $pouvoirsRepository, CommentRepository $commentRepository, Request $request, EntityManagerInterface $em): Response //selec ce que j'ai besoins afficher
    {
     
        $pouvoirs = $pouvoirsRepository->findAll(); // pour afficher tt les pouvoirs

        return $this->render('pouvoirs/index.html.twig', [
            'pouvoirs' => $pouvoirs,  //permet envoyer a mon fichier les donnes en back
        ]);
     
    }
}
