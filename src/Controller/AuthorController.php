<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;  // Correct import
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;  // Annotation Route
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

     
    
    #[Route('/Afficheee', name: 'app_Affiche')]
    public function affiche(AuthorRepository $repository): Response
    {
        $author = $repository->findAll();
        return $this->render('author/affiche.html.twig', ['author' => $author]);
    }




    #[Route('/AddStatique', name: 'app_Statique')]
    public function addStatique(EntityManagerInterface $em): Response
    {
        $author1 = new Author();
        $author1->setUsername("test");
        $author1->setEmail("testt@gmail.com");

        $em->persist($author1);
        $em->flush();

        return $this->redirectToRoute('app_Affiche');
    }





    #[Route('/ajouter', name: 'app_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->add('ajouter', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('app_Affiche');
        }

        return $this->render('author/add.html.twig', ['form' => $form->createView()]);
    }




    #[Route('/edit/{id}', name: 'edit')]
public function edit(Request $request, Author $author, EntityManagerInterface $em): Response
{
    // Création du formulaire avec les données de l'auteur récupéré par ID
    $form = $this->createForm(AuthorType::class, $author);
    $form->add('edit', SubmitType::class);
    $form->handleRequest($request);

    // Vérification de la soumission et de la validation du formulaire
    if ($form->isSubmitted() && $form->isValid()) {
        // Sauvegarder les modifications dans la base de données
        $em->flush();

        // Redirection après l'édition réussie
        return $this->redirectToRoute('app_Affiche');
    }

    // Rendu de la vue 'edit.html.twig' avec le formulaire
    return $this->render('author/edit.html.twig', [
        'form' => $form->createView(),
    ]);
}



/*
#[Route('/author/delete/{id}', name: 'delete')]
public function delete(Author $author, EntityManagerInterface $em): Response
{
    $em->remove($author);
    $em->flush();

    return $this->redirectToRoute('app_Affiche');
}*/

#[Route('/author/delete/{id}', name: 'delete')]
public function delete(Author $author, EntityManagerInterface $em): Response
{
    // Supprimez les livres associés à l'auteur
    foreach ($author->getLivres() as $livre) {
        $em->remove($livre);
    }

    // Ensuite, supprimez l'auteur
    $em->remove($author);
    $em->flush();

    return $this->redirectToRoute('app_Affiche');
}



}
