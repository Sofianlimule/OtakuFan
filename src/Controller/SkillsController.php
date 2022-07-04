<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\SkillsRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillsController extends AbstractController
{
    #[Route('/skills', name: 'app_skills')]
    public function index(SkillsRepository $skillsRepository, CommentRepository $commentRepository, Request $request, EntityManagerInterface $em): Response //selec ce que j'ai besoins afficher
    {
        
        $skills = $skillsRepository->findAll(); // pour afficher tt les pouvoirs

        return $this->render('skills/index.html.twig', [
            'skills' => $skills, //permet envoyer a mon fichier les donnes en back
        ]);
     
        
       
    }
}
