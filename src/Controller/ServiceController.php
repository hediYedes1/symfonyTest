<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    #[Route('/second1/{name}', name: 'app_author')]
    public function showauthor(string $name): Response
    {
        return $this->render('showauthor.html.twig', ['n' => $name]);
    }

    #[Route('/showlist', name: 'app_showlist')]
    public function listAuthors(): Response
    {
        $second = [
            ['id' => 1, 'picture' => 'images/VictorHugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100],
            ['id' => 2, 'picture' => 'images/TahaHussein.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200],
            ['id' => 3, 'picture' => 'images/WilliamShakespeare.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300],
        ];

        return $this->render('list.html.twig', ['second' => $second]);
    }

    #[Route("/second/{id}", name:"author_details")]
    public function authorDetails(int $id): Response
    {
        $authors = [
            1 => ['id' => 1, 'picture' => 'images/VictorHugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100],
            2 => ['id' => 2, 'picture' => 'images/TahaHussein.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200],
            3 => ['id' => 3, 'picture' => 'images/WilliamShakespeare.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300],
        ];

        if (!isset($authors[$id])) {
            throw $this->createNotFoundException('Auteur non trouvé');
        }

        $author = $authors[$id];

        return $this->render('showauthor.html.twig', ['second' => $author]);
    }
}
