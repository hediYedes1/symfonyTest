<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\AuthorType;
use App\Form\LivreType;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Request;  // Correct import
  // Annotation Route
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LivreController extends AbstractController
{
    #[Route('/livre', name: 'app_livre')]
    public function index(): Response
    {
        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
        ]);
    }
    #[Route('/Livre/AfficherLivre', name: 'app_afficher_Livre')]
    public function AfficherLivre(LivreRepository $repository){
        $livre =  $repository->findAll();
        return $this->render('livre/AfficherLivre.html.twig', ['Livre' => $livre]);


    }
/*

    #[Route('/Livre/AjouterLivre', name: 'app_Ajouter_Livre')]
    public function AjouterLivre(Request $request, EntityManagerInterface $em): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->add('ajouter', SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $author = $livre->getAuthor();
            if ($author) {
                $author->setNbBooks($author->getNbBooks() + 1);
            }
            $em->persist($livre);
            $em->flush();
            return $this->redirectToRoute('app_afficher_Livre');
        }
        return $this->render('livre/AjouterLivre.html.twig', ['form' => $form->createView()]);
    }
   
*/
    #[Route('/livre/delete/{id}', name: 'delete_livre')]
public function delete(Livre $livre, EntityManagerInterface $em): Response
{
    $em->remove($livre);
    $em->flush();

    return $this->redirectToRoute('app_afficher_Livre');
}


#[Route('/livre/modifierLivre/{id}', name: 'app_modifier_livre')]
public function edit(Request $request, Livre $livre, EntityManagerInterface $em): Response
{
    // Création du formulaire avec les données de l'auteur récupéré par ID
    $form = $this->createForm(LivreType::class, $livre);
    $form->add('edit', SubmitType::class);
    $form->handleRequest($request);

    // Vérification de la soumission et de la validation du formulaire
    if ($form->isSubmitted() && $form->isValid()) {
        // Sauvegarder les modifications dans la base de données
        $em->flush();

        // Redirection après l'édition réussie
        return $this->redirectToRoute('app_afficher_Livre');
    }

    // Rendu de la vue 'edit.html.twig' avec le formulaire
    return $this->render('livre/ModifierLivre.html.twig', [
        'form' => $form->createView(),
    ]);
}

}
