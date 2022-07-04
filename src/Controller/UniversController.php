<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Univers;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\UniversRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UniversController extends AbstractController
{
    #[Route('/univers', name: 'app_univers')]
    public function index(UniversRepository $universRepository, CommentRepository $commentRepository, Request $request, EntityManagerInterface $em): Response //selec ce que j'ai besoins afficher
    {
        $univers = $universRepository->findAll(); // pour afficher tt les univers
        $user = $this->getUser();

        return $this->render('univers/Univers.html.twig', [
            'controller_name' => 'UniversController',
            'univers' => $univers //permet envoyer a mon fichier les donnes en back
        ]);
    }

    #[Route('/univers/{id<\d+>}', name: 'app_univers_single')]
    public function universSingle(Univers $univers,CommentRepository $commentRepository, Request $request, EntityManagerInterface $em): Response //selec ce que j'ai besoins afficher
    {
        $personnagesUnivers = $univers->getPersonnages(); // pour afficher tt les univers unique et personnages des univers uniques
        $user = $this->getUser();

        $comments = $commentRepository->findAll();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setAuthor($this->getUser());
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('app_univers_single');
        }

        return $this->render('univers/univers-detail.html.twig', [ //permet envoyer a mon fichier les donnes en back
            'user' => $user,
            'comments' => $comments,
            'commentform' => $form->createView(),
            'personnages' => $personnagesUnivers,
            'univers' => $univers
        ]);
    }
}
