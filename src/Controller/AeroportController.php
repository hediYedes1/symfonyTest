<?php

namespace App\Controller;

use App\Entity\Aeroport;
use App\Form\AeroportType;
use App\Repository\AeroportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;  // Correct import
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;  // Annotation Route
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AeroportController extends AbstractController
{
    #[Route('/aeroport', name: 'app_aeroport')]
    public function index(): Response
    {
        return $this->render('aeroport/index.html.twig', [
            'controller_name' => 'AeroportController',
        ]);
    }


    #[Route('/Aeroport/afficher', name: 'app_Affiche_ae')]
    public function affiche(AeroportRepository $repository): Response
    {
        $aeroport = $repository->findAll();
        return $this->render('aeroport/afficheAeroport.html.twig', ['aeroport' => $aeroport]);
    }


    #[Route('/aeroport/ajouterae', name: 'app_ajouter_ae')]
    public function ajouterAeroport(Request $request, EntityManagerInterface $em): Response
    {
        $aeroport = new Aeroport();
        $form = $this->createForm(AeroportType::class, $aeroport);
        $form->add('ajouter', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($aeroport);
            $em->flush();

            return $this->redirectToRoute('app_Affiche_ae');
        }

        return $this->render('aeroport/ajouterAeroport.html.twig', ['form' => $form->createView()]);
    }
}
