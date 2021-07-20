<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Film;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire/add/{id}", name="add_commentaire")
     */
    public function addCommentaire(Film $film, Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $addCommentaire = $this->createForm(CommentaireType::class, $commentaire);

        $addCommentaire->handleRequest($request);

        if($addCommentaire->isSubmitted() && $addCommentaire->isValid()){
            $commentaire = $addCommentaire->getData();

            $commentaire->setFilm($film);
            $commentaire->setAuteur($this->getUser());
            $commentaire->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('detail_film', ['id' => $film->getId()]);
        }

        return $this->render('commentaire/add.html.twig', [
            'add_commentaire' => $addCommentaire->createView()
        ]);
    }
}
