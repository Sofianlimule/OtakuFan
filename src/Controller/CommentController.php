<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Personnages;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/comment')]
class CommentController extends AbstractController
{
    #[Route('/', name: 'app_comment_index')]
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findAll();
        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/create', name: 'app_comment_create')]
    #[IsGranted('ROLE_USER', message: '')]
    public function create(Request $request, EntityManagerInterface $em,Personnages $personnages): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setAuthor($this->getUser());
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('app_personnages');
        }

        return $this->renderForm('comment/create.html.twig', [
            'commentform' => $form,
        ]);
    }

    #[Route('/delete/{id<\d+>}', name: 'app_comment_delete')]

    public function delete(Comment $comment, EntityManagerInterface $em): Response
    {
        if ($this->getUser() === $comment->getAuthor()) {

                $em->remove($comment);
                $em->flush();

                return $this->redirectToRoute('app_personnages');

        }

        return $this->redirectToRoute('app_personnages');

    }

    #[Route('/edit/{id<\d+>}', name: 'app_comment_edit')]
    public function edit(Comment $comment, Request $request, EntityManagerInterface $em): Response

    {

        if ($this->getUser() === $comment->getAuthor()) {

            $form = $this->createForm(CommentType::class, $comment);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em->flush();

                $this->addFlash('success', 'commentaire modifié avec succès !');



                return $this->redirectToRoute('app_personnages');

            }



            return $this->renderForm('comment/edit.html.twig', [

                'commentform' => $form,

                'comment' => $comment,

                ]);

        }



        return $this->redirectToRoute('app_personnages');

    }


}