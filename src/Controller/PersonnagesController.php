<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Personnages;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PersonnagesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonnagesController extends AbstractController
{
    #[Route('/personnages', name: 'app_personnages')]
    public function index(PersonnagesRepository $personnagesRepository, CommentRepository $commentRepository, Request $request, EntityManagerInterface $em): Response //selec ce que j'ai besoins afficher
    {
        $personnages = $personnagesRepository->findAll(); // pour afficher tt les personnages
        $user = $this->getUser(); 

        $comments = $commentRepository->findBy([]);
        $comment = new Comment(); // inserer un nov comm
        $form = $this->createForm(CommentType::class, $comment); // creer le formulaire pour les comms
        $form->handleRequest($request); //

        if($form->isSubmitted() && $form->isValid()){ //valider et envoie le form si il est remplie
            $comment->setAuthor($this->getUser()); // faire le lien avec  l'users qui author comms
            $em->persist($comment); //prepare donne 
            $em->flush(); //envoie les donnes

            return $this->redirectToRoute('app_personnages'); //permet envoyer a mon fichier les donnes en back
        }

        return $this->render('personnages/personnages.html.twig', [
            'user' => $user,
            'comments' => $comments,
            'commentform' => $form->createView(),
            'personnages' => $personnages,
        ]);

    }

    #[Route('/personnages/{id<\d+>}', name: 'app_personnages_details')]
    public function details(Personnages $personnages,CommentRepository $commentRepository, Request $request, EntityManagerInterface $em): Response //selec ce que j'ai besoins afficher
    {
        $user = $this->getUser();

        $comments = $commentRepository->findAll();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setAuthor($this->getUser());
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('app_personnages_details');
        }

        return $this->render('personnages/detail_personnages.html.twig', [
            'user' => $user,
            'comments' => $comments,
            'commentform' => $form->createView(),
            'personnage' => $personnages,
        ]);
     }
}
