<?php

namespace App\Controller;

use App\Entity\AnneeAcademique;
use App\Form\AnneeAcademiqueType;
use App\Repository\AnneeAcademiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/administration/annee-academique/gestion', name: 'app_annee_academique_')]
class AnneeAcademiqueController extends AbstractController
{
    #[Route('/liste', name: 'index', methods: ['GET'])]
    public function index(AnneeAcademiqueRepository $anneeAcademiqueRepository): Response
    {
        return $this->render('annee_academique/index.html.twig', [
            'annee_academiques' => $anneeAcademiqueRepository->findAll(),
        ]);
    }

    #[Route('/nouveau', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, AnneeAcademiqueRepository $anneeAcademiqueRepository): Response
    {
        $anneeAcademique = new AnneeAcademique();
        $annees_anterieures = $anneeAcademiqueRepository->findAll();
        $form = $this->createForm(AnneeAcademiqueType::class, $anneeAcademique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($anneeAcademique->isAnneeEncours() == true){
                foreach($annees_anterieures as $annee_anterieure){
                    $annee_anterieure->setAnneeEncours(false);
                }
            }
            $this->addFlash('success', 'Année académique '.$anneeAcademique->getDateDebut().' - '.$anneeAcademique->getDateFin(). ' disponible');
            $entityManager->persist($anneeAcademique);
            $entityManager->flush();

            return $this->redirectToRoute('app_annee_academique_index');
        }

        return $this->render('annee_academique/new.html.twig', [
            'annee_academique' => $anneeAcademique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edition', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AnneeAcademique $anneeAcademique, EntityManagerInterface $entityManager, AnneeAcademiqueRepository $anneeAcademiqueRepository): Response
    {
        $annees_anterieures = $anneeAcademiqueRepository->findAll();
        $form = $this->createForm(AnneeAcademiqueType::class, $anneeAcademique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($anneeAcademique->isAnneeEncours() == true){
                foreach($annees_anterieures as $annee_anterieure){
                    if($annee_anterieure->getId() != $anneeAcademique->getId()){
                        $annee_anterieure->setAnneeEncours(false);
                    }
                }
            }
            $this->addFlash('success', 'Année académique '.$anneeAcademique->getDateDebut().' - '.$anneeAcademique->getDateFin(). ' modifiée et disponible');
            $entityManager->flush();

            return $this->redirectToRoute('app_annee_academique_index');
        }

        return $this->render('annee_academique/edit.html.twig', [
            'annee_academique' => $anneeAcademique,
            'form' => $form,
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, AnneeAcademique $anneeAcademique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anneeAcademique->getId(), $request->request->get('_token'))) {
            $this->addFlash('success', 'Année académique '.$anneeAcademique->getDateDebut().' - '.$anneeAcademique->getDateFin(). ' supprimée');
            $entityManager->remove($anneeAcademique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annee_academique_index');
    }
}
