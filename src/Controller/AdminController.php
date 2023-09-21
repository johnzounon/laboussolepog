<?php

namespace App\Controller;

use App\Repository\CarnetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/administration', name: 'app_admin_')]
class AdminController extends AbstractController
{
    #[Route('/tableau-de-bord', name: 'dashboard')]
    public function index(CarnetRepository $carnetRepository): Response
    {
        
        return $this->render('admin/index.html.twig', [
        'carnets_inscription_primaire' => $carnetRepository->findBy(['groupe' => 'ISP', 'carnet_encours' => true]),
        'carnets_inscription_college' => $carnetRepository->findBy(['groupe' => 'ISC', 'carnet_encours' => true]),
        'carnets_reinscription_primaire' => $carnetRepository->findBy(['groupe' => 'RSP', 'carnet_encours' => true]),
        'carnets_scolarite_primaire' => $carnetRepository->findBy(['groupe' => 'SCP', 'carnet_encours' => true]),
        'carnets_scolarite_college' => $carnetRepository->findBy(['groupe' => 'SCC', 'carnet_encours' => true]),
        'carnets_arrieres_primaire' => $carnetRepository->findBy(['groupe' => 'ARP', 'carnet_encours' => true]),
        'carnets_arrieres_college' => $carnetRepository->findBy(['groupe' => 'ARC', 'carnet_encours' => true]),
        'carnets_tenues' => $carnetRepository->findBy(['groupe' => 'CTN']),
        ]);
    }


    #[Route('/cycle/gestion', name: 'cycle')]
    public function cycle(): Response
    {
        return $this->render('admin/cycle.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/classe/gestion', name: 'classe')]
    public function classe(): Response
    {
        return $this->render('admin/classe.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/eleve/gestion', name: 'eleve')]
    public function eleve(): Response
    {
        return $this->render('admin/eleve.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/enseignant/gestion', name: 'enseignant')]
    public function enseignant(): Response
    {
        return $this->render('admin/enseignant.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/professeur/gestion', name: 'professeur')]
    public function professeur(): Response
    {
        return $this->render('admin/professeur.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/employe/gestion', name: 'employe')]
    public function employe(): Response
    {
        return $this->render('admin/employe.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/matiere/gestion', name: 'matiere')]
    public function matiere(): Response
    {
        return $this->render('admin/matiere.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }



    
}
