<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/film", name="film")
     */
    public function index(): Response
    {
        $films = $this->entityManager->getRepository(Film::class)->findAll();

        return $this->render('film/index.html.twig', [
            'films' => $films
        ]);
    }

    /**
     * @Route("/film/add", name="add_film")
     */
    public function addFilm(Request $request): Response
    {
        $film = new Film();
        $addFilm = $this->createForm(FilmType::class, $film);

        $addFilm->handleRequest($request);

        if($addFilm->isSubmitted() && $addFilm->isValid()){
            $film = $addFilm->getData();

            $this->entityManager->persist($film);
            $this->entityManager->flush();

            return $this->redirectToRoute('film');
        }

        return $this->render('film/add.html.twig', [
            'add_film' => $addFilm->createView()
        ]);
    }

    /**
     * @Route("/film/{id}", name="detail_film")
     */
    public function filmDetail(Film $film): Response
    {
        return $this->render('film/detail.html.twig', [
            'film' => $film
        ]);
    }
}
