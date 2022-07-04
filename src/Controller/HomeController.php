<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\UniversRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(UniversRepository $universRepository , CommentRepository $commentRepository, Request $request, EntityManagerInterface $em): Response //selec ce que j'ai besoins afficher
    {
        $univers = $universRepository->findAll(); // pour afficher tt les univers
        return $this->render('home/index.html.twig', ['univers' => $univers]); //permet envoyer a mon fichier les donnes en back
        return $this->render('home/index.html.twig'); // redirection page home
    }

}