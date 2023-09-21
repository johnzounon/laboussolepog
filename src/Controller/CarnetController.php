<?php

namespace App\Controller;

use App\Entity\AnneeAcademique;
use App\Entity\Carnet;
use App\Entity\Inscription;
use App\Entity\ScolariteCollege;
use App\Entity\ScolaritePrimaire;
use App\Form\AdminInscriptionCollegeType;
use App\Form\AdminInscriptionPrimaireType;
use App\Form\AdminScolariteCollegeType;
use App\Form\AdminScolaritePrimaireType;
use App\Form\CarnetType;
use App\Form\InscriptionCollegeType;
use App\Form\InscriptionPrimaireType;
use App\Form\ReinscriptionPrimaireType;
use App\Form\ScolariteCollegeType;
use App\Form\ScolaritePrimaireType;
use App\Repository\AnneeAcademiqueRepository;
use App\Repository\CarnetRepository;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/administration/carnet/gestion', name: 'app_carnet_')]
class CarnetController extends AbstractController
{
    #[Route('/liste', name: 'index', methods: ['GET'])]
    public function index(CarnetRepository $carnetRepository): Response
    {
        return $this->render('carnet/index.html.twig', [
            'carnets_inscription_primaire' => $carnetRepository->findBy(['groupe' => 'ISP'],['numero' => 'DESC']),
            'carnets_inscription_college' => $carnetRepository->findBy(['groupe' => 'ISC'],['numero' => 'DESC']),
            'carnets_reinscription_primaire' => $carnetRepository->findBy(['groupe' => 'RSP'],['numero' => 'DESC']),
            'carnets_scolarite_primaire' => $carnetRepository->findBy(['groupe' => 'SCP'],['numero' => 'DESC']),
            'carnets_scolarite_college' => $carnetRepository->findBy(['groupe' => 'SCC'],['numero' => 'DESC']),
            'carnets_arrieres_primaire' => $carnetRepository->findBy(['groupe' => 'ARP'],['numero' => 'DESC']),
            'carnets_arrieres_college' => $carnetRepository->findBy(['groupe' => 'ARC'],['numero' => 'DESC']),
            'carnets_tenues' => $carnetRepository->findBy(['groupe' => 'CTN'],['numero' => 'DESC']),
            
        ]);
    }

    #[Route('/nouveau', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,AnneeAcademiqueRepository $anneeAcademiqueRepository, CarnetRepository $carnetRepository): Response
    {
        $carnets_inscription_primaire = $carnetRepository->findBy(['groupe' => 'ISP']);
        $carnets_inscription_college = $carnetRepository->findBy(['groupe' => 'ISC']);
        $carnets_reinscription_primaire = $carnetRepository->findBy(['groupe' => 'RSP']);
        $carnets_scolarite_primaire = $carnetRepository->findBy(['groupe' => 'SCP']);
        $carnets_scolarite_college = $carnetRepository->findBy(['groupe' => 'SCC']);
        $carnets_arrieres_primaire = $carnetRepository->findBy(['groupe' => 'ARP']);
        $carnets_arrieres_college = $carnetRepository->findBy(['groupe' => 'ARC']);
        $carnets_tenues = $carnetRepository->findBy(['groupe' => 'CTN']);
        $annees_encours = $anneeAcademiqueRepository->findAll();
        $carnet = new Carnet();
        $form = $this->createForm(CarnetType::class, $carnet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($carnet->getGroupe() == 'ISP'){

                $carnet->setNumero(count($carnets_inscription_primaire) + 1);
                $carnet->setCarnetEncours(true);

                foreach($annees_encours as $annee_encours){
                    if($annee_encours->isAnneeEncours() == true){
                        $carnet->setAnneeAcademique($annee_encours);
                    }
                }

                foreach($carnets_inscription_primaire as $carnet_inscription_primaire){
                    if($carnet_inscription_primaire->isCarnetEncours() == true){
                        $carnet_inscription_primaire->setCarnetEncours(false);
                    }
                }

                $this->addFlash('success', 'Carnet Inscription Primaire N°'.$carnet->getNumero(). ' disponible');

            }

            if($carnet->getGroupe() == 'ISC'){

                $carnet->setNumero(count($carnets_inscription_college) + 1);
                $carnet->setCarnetEncours(true);
                
                foreach($annees_encours as $annee_encours){
                    if($annee_encours->isAnneeEncours() == true){
                        $carnet->setAnneeAcademique($annee_encours);
                    }
                }

                foreach($carnets_inscription_college as $carnet_inscription_college){
                    if($carnet_inscription_college->isCarnetEncours() == true){
                        $carnet_inscription_college->setCarnetEncours(false);
                    }
                }

                $this->addFlash('success', 'Carnet Inscription Collège N°'.$carnet->getNumero(). ' disponible');

            }

            if($carnet->getGroupe() == 'RSP'){

                $carnet->setNumero(count($carnets_reinscription_primaire) + 1);
                $carnet->setCarnetEncours(true);
                
                foreach($annees_encours as $annee_encours){
                    if($annee_encours->isAnneeEncours() == true){
                        $carnet->setAnneeAcademique($annee_encours);
                    }
                }

                foreach($carnets_reinscription_primaire as $carnet_reinscription_primaire){
                    if($carnet_reinscription_primaire->isCarnetEncours() == true){
                        $carnet_reinscription_primaire->setCarnetEncours(false);
                    }
                }

                $this->addFlash('success', 'Carnet Réinscription Primaire N°'.$carnet->getNumero(). ' disponible');

            }

            if($carnet->getGroupe() == 'SCP'){

                $carnet->setNumero(count($carnets_scolarite_primaire) + 1);
                $carnet->setCarnetEncours(true);
                
                foreach($annees_encours as $annee_encours){
                    if($annee_encours->isAnneeEncours() == true){
                        $carnet->setAnneeAcademique($annee_encours);
                    }
                }

                foreach($carnets_scolarite_primaire as $carnet_scolarite_primaire){
                    if($carnet_scolarite_primaire->isCarnetEncours() == true){
                        $carnet_scolarite_primaire->setCarnetEncours(false);
                    }
                }

                $this->addFlash('success', 'Carnet Scolarité Primaire N°'.$carnet->getNumero(). ' disponible');

            }

            if($carnet->getGroupe() == 'SCC'){

                $carnet->setNumero(count($carnets_scolarite_college) + 1);
                $carnet->setCarnetEncours(true);
                
                foreach($annees_encours as $annee_encours){
                    if($annee_encours->isAnneeEncours() == true){
                        $carnet->setAnneeAcademique($annee_encours);
                    }
                }

                foreach($carnets_scolarite_college as $carnet_scolarite_college){
                    if($carnet_scolarite_college->isCarnetEncours() == true){
                        $carnet_scolarite_college->setCarnetEncours(false);
                    }
                }

                $this->addFlash('success', 'Carnet Scolarité Collège N°'.$carnet->getNumero(). ' disponible');
            }

            if($carnet->getGroupe() == 'ARP'){

                $carnet->setNumero(count($carnets_arrieres_primaire) + 1);
                $carnet->setCarnetEncours(true);
                
                foreach($annees_encours as $annee_encours){
                    if($annee_encours->isAnneeEncours() == true){
                        $carnet->setAnneeAcademique($annee_encours);
                    }
                }

                foreach($carnets_arrieres_primaire as $carnet_arrieres_primaire){
                    if($carnet_arrieres_primaire->isCarnetEncours() == true){
                        $carnet_arrieres_primaire->setCarnetEncours(false);
                    }
                }

                $this->addFlash('success', 'Carnet Arriérés Primaire N°'.$carnet->getNumero(). ' disponible');
            }

            if($carnet->getGroupe() == 'ARC'){

                $carnet->setNumero(count($carnets_arrieres_college) + 1);
                $carnet->setCarnetEncours(true);
                
                foreach($annees_encours as $annee_encours){
                    if($annee_encours->isAnneeEncours() == true){
                        $carnet->setAnneeAcademique($annee_encours);
                    }
                }

                foreach($carnets_arrieres_college as $carnet_arrieres_college){
                    if($carnet_arrieres_college->isCarnetEncours() == true){
                        $carnet_arrieres_college->setCarnetEncours(false);
                    }
                }

                $this->addFlash('success', 'Carnet Arriérés Collège N°'.$carnet->getNumero(). ' disponible');
                
            }

            if($carnet->getGroupe() == 'CTN'){

                $carnet->setNumero(count($carnets_tenues) + 1);
                $carnet->setCarnetEncours(true);
                
                foreach($annees_encours as $annee_encours){
                    if($annee_encours->isAnneeEncours() == true){
                        $carnet->setAnneeAcademique($annee_encours);
                    }
                }

                foreach($carnets_tenues as $carnet_tenues){
                    if($carnet_tenues->isCarnetEncours() == true){
                        $carnet_tenues->setCarnetEncours(false);
                    }
                }

                $this->addFlash('success', 'Carnet Tenue N°'.$carnet->getNumero(). ' disponible');
                
            }

            $entityManager->persist($carnet);
            $entityManager->flush();

            return $this->redirectToRoute('app_carnet_index');
        }

        return $this->render('carnet/new.html.twig', [
            'carnet' => $carnet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/visualiser', name: 'show', methods: ['GET'])]
    public function show(Carnet $carnet): Response
    {
        return $this->render('carnet/show.html.twig', [
            'carnet' => $carnet,
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Carnet $carnet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carnet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carnet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_carnet_index');
    }

    #[Route('/inscription-primaire/tous', name: 'all_inscription_primaire')]
    public function allInscriptionPrimaire(CarnetRepository $carnetRepository): Response
    {
        
        return $this->render('carnet/all_inscription_primaire.html.twig', [
        'carnets_inscription_primaire' => $carnetRepository->findBy(['groupe' => 'ISP'],['numero' => 'DESC'])
        ]);
    }

    #[Route('/inscription-primaire/nouveau/{id}', name: 'new_inscription_primaire', methods: ['GET', 'POST'])]
    public function newInscriptionPrimaire(Request $request, EntityManagerInterface $entityManager, Carnet $carnet): Response
    {
        $inscription = new Inscription();
        $user = $this->getUser();
        if($user->getRoles()[0] == 'ROLE_ADMIN'){
            $form = $this->createForm(AdminInscriptionPrimaireType::class, $inscription);
        }
        else{
            $form = $this->createForm(InscriptionPrimaireType::class, $inscription);
        }
        
        $form->handleRequest($request);
       

        if ($form->isSubmitted() && $form->isValid()) {
            $inscription->setNomComplet($inscription->getNom().' '.$inscription->getPrenom());
            $inscription->setCarnet($carnet);
            $inscription->setMontantChiffre(18000);
            $inscription->setMontantLettre('Dix-huit mille');

            if($user->getRoles()[0] == 'ROLE_USER'){
                $inscription->setAgent($this->getUser());
                $inscription->setDate(new \DateTime());
            }
            
            
            $this->addFlash('success', 'Inscription de l\'élève '.$inscription->getNom().' '.$inscription->getPrenom().' au Primaire réussie');
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_carnet_new_inscription_primaire',['id' => $carnet->getId()]);
        }

        return $this->render('carnet/new_inscription_primaire.html.twig', [
            'inscription' => $inscription,
            'carnet' => $carnet,
            'form' => $form,
        ]);
    }

    #[Route('/inscription-college/tous', name: 'all_inscription_college')]
    public function allInscriptionCollege(CarnetRepository $carnetRepository): Response
    {
        
        return $this->render('carnet/all_inscription_college.html.twig', [
        'carnets_inscription_college' => $carnetRepository->findBy(['groupe' => 'ISC'],['numero' => 'DESC'])
        ]);
    }

    #[Route('/inscription-college/nouveau/{id}', name: 'new_inscription_college', methods: ['GET', 'POST'])]
    public function newInscriptionCollege(Request $request, EntityManagerInterface $entityManager, Carnet $carnet): Response
    {
        $inscription = new Inscription();
        $user = $this->getUser();

        if($user->getRoles()[0] == 'ROLE_ADMIN'){
            $form = $this->createForm(AdminInscriptionCollegeType::class, $inscription);
        }
        else{
            $form = $this->createForm(InscriptionCollegeType::class, $inscription);
        }

        
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $inscription->setNomComplet($inscription->getNom().' '.$inscription->getPrenom());
            $inscription->setCarnet($carnet);
            $inscription->setMontantChiffre(30000);
            $inscription->setMontantLettre('Trente mille');

            if($user->getRoles()[0] == 'ROLE_USER'){
                $inscription->setAgent($this->getUser());
                $inscription->setDate(new \DateTime());
            }

            $this->addFlash('success', 'Inscription de l\'élève '.$inscription->getNom().' '.$inscription->getPrenom().' au Collège réussie');
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_carnet_new_inscription_college',['id' => $carnet->getId()]);
        }

        return $this->render('carnet/new_inscription_college.html.twig', [
            'inscription' => $inscription,
            'carnet' => $carnet,
            'form' => $form,
        ]);
    }

    #[Route('/reinscription-primaire/tous', name: 'all_reinscription_primaire')]
    public function allReinscriptionPrimaire(CarnetRepository $carnetRepository): Response
    {
        
        return $this->render('carnet/all_reinscription_primaire.html.twig', [
        'carnets_reinscription_primaire' => $carnetRepository->findBy(['groupe' => 'RSP'],['numero' => 'DESC'])
        ]);
    }

    #[Route('/reinscription-primaire/nouveau/{id}', name: 'new_reinscription_primaire', methods: ['GET', 'POST'])]
    public function newReinscriptionPrimaire(Request $request, EntityManagerInterface $entityManager, Carnet $carnet): Response
    {
        $inscription = new Inscription();
        $user = $this->getUser();
        if($user->getRoles()[0] == 'ROLE_ADMIN'){
            $form = $this->createForm(AdminInscriptionPrimaireType::class, $inscription);
        }
        else{
            $form = $this->createForm(ReinscriptionPrimaireType::class, $inscription);
        }
       
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $inscription->setNomComplet($inscription->getNom().' '.$inscription->getPrenom());
            $inscription->setCarnet($carnet);
            $inscription->setMontantChiffre(13000);
            $inscription->setMontantLettre('Treize mille');

            if($user->getRoles()[0] == 'ROLE_USER'){
                $inscription->setAgent($this->getUser());
                $inscription->setDate(new \DateTime());
            }

            $this->addFlash('success', 'Réinscription de l\'élève '.$inscription->getNom().' '.$inscription->getPrenom().' au Primaire réussie');
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_carnet_new_reinscription_primaire',['id' => $carnet->getId()]);
        }

        return $this->render('carnet/new_reinscription_primaire.html.twig', [
            'inscription' => $inscription,
            'carnet' => $carnet,
            'form' => $form,
        ]);
    }

    #[Route('/scolarite-college/tous', name: 'all_scolarite_college')]
    public function allScolariteCollege(CarnetRepository $carnetRepository): Response
    {
        
        return $this->render('carnet/all_scolarite_college.html.twig', [
        'carnets_scolarite_college' => $carnetRepository->findBy(['groupe' => 'SCC'],['numero' => 'DESC'])
        ]);
    }

    #[Route('/scolarite-college/nouveau/{id}', name: 'new_scolarite_college', methods: ['GET', 'POST'])]
    public function newScolariteCollege(Request $request, EntityManagerInterface $entityManager, Carnet $carnet): Response
    {
        $scolarite = new ScolariteCollege();
        $user = $this->getUser();

        if($user->getRoles()[0] == 'ROLE_ADMIN'){
            $form = $this->createForm(ScolariteCollegeType::class, $scolarite);
        }
        else{
            $form = $this->createForm(ScolariteCollegeType::class, $scolarite);
        }

        
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $eleve = $scolarite->getEleve();
            $scolarite->setCarnet($carnet);

            if(
                $scolarite->getClasse()->getValeur() == '6EME' || 
                $scolarite->getClasse()->getValeur() == '5EME'
            ){
                if($scolarite->getTarifMensuel() == null){
                    $scolarite->setTarifMensuel(110000);
                } 
            }

            if(
                $scolarite->getClasse()->getValeur() == '4EME'
            ){
                if($scolarite->getTarifMensuel() == null){
                    $scolarite->setTarifMensuel(115000);
                } 
            }

            if(
                $scolarite->getClasse()->getValeur() == '3EME'
            ){
                if($scolarite->getTarifMensuel() == null){
                    $scolarite->setTarifMensuel(130000);
                } 
            }

            if(
                $scolarite->getClasse()->getValeur() == '2NDES' || 
                $scolarite->getClasse()->getValeur() == '2NDELE' ||
                $scolarite->getClasse()->getValeur() == '1ERES' || 
                $scolarite->getClasse()->getValeur() == '1ERELE'
            ){
                if($scolarite->getTarifMensuel() == null){
                    $scolarite->setTarifMensuel(140000);
                } 
            }

            if($user->getRoles()[0] == 'ROLE_USER'){
                $scolarite->setAgent($this->getUser());
                $scolarite->setDate(new \DateTime());
            }

            $this->addFlash('success', $scolarite->getMontantChiffre().' FCFA ajouté à la scolarité de l\'élève "'.$eleve->getNom().'" '.$eleve->getPrenom().'"');
            $entityManager->persist($scolarite);
            $entityManager->flush();

            return $this->redirectToRoute('app_carnet_new_scolarite_college',
            [
                'id' => $carnet->getId()
            ]);
        }

        return $this->render('carnet/new_scolarite_college.html.twig', [
            'scolarite' => $scolarite,
            'carnet' => $carnet,
            'form' => $form,
        ]);
    }

    #[Route('/scolarite-primaire/tous', name: 'all_scolarite_primaire')]
    public function allScolaritePrimaire(CarnetRepository $carnetRepository): Response
    {
        return $this->render('carnet/all_scolarite_primaire.html.twig', [
        'carnets_scolarite_primaire' => $carnetRepository->findBy(['groupe' => 'SCP'],['numero' => 'DESC'])
        ]);
    }

    #[Route('/scolarite-primaire/nouveau/{id}', name: 'new_scolarite_primaire', methods: ['GET', 'POST'])]
    public function newScolaritePrimaire(Request $request, EntityManagerInterface $entityManager, Carnet $carnet): Response
    {
        $scolarite = new ScolaritePrimaire();
        $user = $this->getUser();

        if($user->getRoles()[0] == 'ROLE_ADMIN'){
            $form = $this->createForm(ScolaritePrimaireType::class, $scolarite);
        }
        else{
            $form = $this->createForm(ScolaritePrimaireType::class, $scolarite);
        }

        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $eleve = $scolarite->getEleve();
            $scolarite->setCarnet($carnet);
            
            if(
                $scolarite->getClasse()->getValeur() == '3ANS' || 
                $scolarite->getClasse()->getValeur() == '4ANS' ||
                $scolarite->getClasse()->getValeur() == '5ANS' ||
                $scolarite->getClasse()->getValeur() == '1EREAN' ||
                $scolarite->getClasse()->getValeur() == '2EMEAN' ||
                $scolarite->getClasse()->getValeur() == '3EMEAN'
            ){
                if($scolarite->getTarifMensuel() == null){
                    $scolarite->setTarifMensuel(20000);
                } 
            }

            if(
                $scolarite->getClasse()->getValeur() == '4EMEAN' ||
                $scolarite->getClasse()->getValeur() == '5EMEAN'
            ){
                if($scolarite->getTarifMensuel() == null){
                    $scolarite->setTarifMensuel(25000);
                } 
            }
            

            if($user->getRoles()[0] == 'ROLE_USER'){
                $scolarite->setAgent($this->getUser());
                $scolarite->setDate(new \DateTime());
            }

            $this->addFlash('success', $scolarite->getMontantChiffre().' FCFA ajouté à la scolarité de l\'élève "'.$eleve->getNom().' '.$eleve->getPrenom().'"');
            $entityManager->persist($scolarite);
            $entityManager->flush();

            return $this->redirectToRoute('app_carnet_new_scolarite_primaire',
            [
                'id' => $carnet->getId()
            ]);
        }

        return $this->render('carnet/new_scolarite_primaire.html.twig', [
            'scolarite' => $scolarite,
            'carnet' => $carnet,
            'form' => $form,
        ]);
    }

    #[Route('/liste-inscrits/primaire/tous', name: 'inscrits_primaire')]
    public function inscritsPrimaire(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3ans = array();
        $inscrits_4ans = array();
        $inscrits_5ans = array();
        $inscrits_1erean = array();
        $inscrits_2emean = array();
        $inscrits_3emean = array();
        $inscrits_4emean = array();
        $inscrits_5emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3ANS'){
                    array_push($inscrits_3ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '4ANS'){
                    array_push($inscrits_4ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '5ANS'){
                    array_push($inscrits_5ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '1EREAN'){
                    array_push($inscrits_1erean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '2EMEAN'){
                    array_push($inscrits_2emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '3EMEAN'){
                    array_push($inscrits_3emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '4EMEAN'){
                    array_push($inscrits_4emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '5EMEAN'){
                    array_push($inscrits_5emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/inscrits_primaire.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3ans' => $inscrits_3ans,
        'inscrits_4ans' => $inscrits_4ans,
        'inscrits_5ans' => $inscrits_5ans,
        'inscrits_1erean' => $inscrits_1erean,
        'inscrits_2emean' => $inscrits_2emean,
        'inscrits_3emean' => $inscrits_3emean,
        'inscrits_4emean' => $inscrits_4emean,
        'inscrits_5emean' => $inscrits_5emean
        ]);
    }

    #[Route('/impression/liste-inscrits/primaire/3ans', name: 'impression_inscrits_primaire_3ans')]
    public function impressionPrimaire3ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3ANS'){
                    array_push($inscrits_3ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_primaire_3ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3ans' => $inscrits_3ans
        ]);
    }

    #[Route('/impression/liste-inscrits/primaire/4ans', name: 'impression_inscrits_primaire_4ans')]
    public function impressionPrimaire4ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_4ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '4ANS'){
                    array_push($inscrits_4ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_primaire_4ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_4ans' => $inscrits_4ans
        ]);
    }

    #[Route('/impression/liste-inscrits/primaire/5ans', name: 'impression_inscrits_primaire_5ans')]
    public function impressionPrimaire5ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_5ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '5ANS'){
                    array_push($inscrits_5ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_primaire_5ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_5ans' => $inscrits_5ans
        ]);
    }

    #[Route('/impression/liste-inscrits/primaire/1ere-annee', name: 'impression_inscrits_primaire_1erean')]
    public function impressionPrimaire1erean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_1erean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '1EREAN'){
                    array_push($inscrits_1erean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_primaire_1erean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_1erean' => $inscrits_1erean
        ]);
    }

    #[Route('/impression/liste-inscrits/primaire/2eme-annee', name: 'impression_inscrits_primaire_2emean')]
    public function impressionPrimaire2emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_2emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '2EMEAN'){
                    array_push($inscrits_2emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_primaire_2emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_2emean' => $inscrits_2emean
        ]);
    }

    #[Route('/impression/liste-inscrits/primaire/3eme-annee', name: 'impression_inscrits_primaire_3emean')]
    public function impressionPrimaire3emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3EMEAN'){
                    array_push($inscrits_3emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_primaire_3emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3emean' => $inscrits_3emean
        ]);
    }

    #[Route('/impression/liste-inscrits/primaire/4eme-annee', name: 'impression_inscrits_primaire_4emean')]
    public function impressionPrimaire4emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_4emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '4EMEAN'){
                    array_push($inscrits_4emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_primaire_4emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_4emean' => $inscrits_4emean
        ]);
    }

    #[Route('/impression/liste-inscrits/primaire/5eme-annee', name: 'impression_inscrits_primaire_5emean')]
    public function impressionPrimaire5emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_5emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '5EMEAN'){
                    array_push($inscrits_5emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_primaire_5emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_5emean' => $inscrits_5emean
        ]);
    }

    #[Route('/liste-inscrits/college/tous', name: 'inscrits_college')]
    public function inscritsCollege(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_6eme = array();
        $inscrits_5eme = array();
        $inscrits_4eme = array();
        $inscrits_3eme = array();
        $inscrits_2ndes = array();
        $inscrits_2ndele = array();
        $inscrits_1eres = array();
        $inscrits_1erele = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '6EME'){
                    array_push($inscrits_6eme, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '5EME'){
                    array_push($inscrits_5eme, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '4EME'){
                    array_push($inscrits_4eme, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '3EME'){
                    array_push($inscrits_3eme, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '2NDES'){
                    array_push($inscrits_2ndes, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '2NDELE'){
                    array_push($inscrits_2ndele, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '1ERES'){
                    array_push($inscrits_1eres, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '1ERELE'){
                    array_push($inscrits_1erele, $inscrit);
                }

            }
        }
        return $this->render('carnet/inscrits_college.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_6eme' => $inscrits_6eme,
        'inscrits_5eme' => $inscrits_5eme,
        'inscrits_4eme' => $inscrits_4eme,
        'inscrits_3eme' => $inscrits_3eme,
        'inscrits_2ndes' => $inscrits_2ndes,
        'inscrits_2ndele' => $inscrits_2ndele,
        'inscrits_1eres' => $inscrits_1eres,
        'inscrits_1erele' => $inscrits_1erele,
        ]);
    }

    #[Route('/impression/liste-inscrits/college/6eme', name: 'impression_inscrits_college_6eme')]
    public function impressionCollege6eme(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_6eme = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '6EME'){
                    array_push($inscrits_6eme, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_college_6eme.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_6eme' => $inscrits_6eme
        ]);
    }

    #[Route('/impression/liste-inscrits/college/5eme', name: 'impression_inscrits_college_5eme')]
    public function impressionCollege5eme(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_5eme = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '5EME'){
                    array_push($inscrits_5eme, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_college_5eme.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_5eme' => $inscrits_5eme
        ]);
    }

    #[Route('/impression/liste-inscrits/college/4eme', name: 'impression_inscrits_college_4eme')]
    public function impressionCollege4eme(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_4eme = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '4EME'){
                    array_push($inscrits_4eme, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_college_4eme.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_4eme' => $inscrits_4eme
        ]);
    }

    #[Route('/impression/liste-inscrits/college/3eme', name: 'impression_inscrits_college_3eme')]
    public function impressionCollege3eme(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3eme = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '3EME'){
                    array_push($inscrits_3eme, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_college_3eme.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_3eme' => $inscrits_3eme
        ]);
    }

    #[Route('/impression/liste-inscrits/college/2nde-s', name: 'impression_inscrits_college_2ndes')]
    public function impressionCollege2ndes(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_2ndes = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '2NDES'){
                    array_push($inscrits_2ndes, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_college_2ndes.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_2ndes' => $inscrits_2ndes
        ]);
    }

    #[Route('/impression/liste-inscrits/college/2nde-le', name: 'impression_inscrits_college_2ndele')]
    public function impressionCollege2ndele(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_2ndele = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '2NDELE'){
                    array_push($inscrits_2ndele, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_college_2ndele.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_2ndele' => $inscrits_2ndele
        ]);
    }

    #[Route('/impression/liste-inscrits/college/1ere-s', name: 'impression_inscrits_college_1eres')]
    public function impressionCollege1eres(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_1eres = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '1ERES'){
                    array_push($inscrits_1eres, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_college_1eres.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_1eres' => $inscrits_1eres
        ]);
    }

    #[Route('/impression/liste-inscrits/college/1ere-le', name: 'impression_inscrits_college_1erele')]
    public function impressionCollege1erele(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_1erele = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '1ERELE'){
                    array_push($inscrits_1erele, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_inscrits_college_1erele.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_1erele' => $inscrits_1erele
        ]);
    }

    #[Route('/liste-reinscrits/primaire/tous', name: 'reinscrits_primaire')]
    public function reinscritsPrimaire(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3ans = array();
        $inscrits_4ans = array();
        $inscrits_5ans = array();
        $inscrits_1erean = array();
        $inscrits_2emean = array();
        $inscrits_3emean = array();
        $inscrits_4emean = array();
        $inscrits_5emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3ANS'){
                    array_push($inscrits_3ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '4ANS'){
                    array_push($inscrits_4ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '5ANS'){
                    array_push($inscrits_5ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '1EREAN'){
                    array_push($inscrits_1erean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '2EMEAN'){
                    array_push($inscrits_2emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '3EMEAN'){
                    array_push($inscrits_3emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '4EMEAN'){
                    array_push($inscrits_4emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '5EMEAN'){
                    array_push($inscrits_5emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/reinscrits_primaire.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3ans' => $inscrits_3ans,
        'inscrits_4ans' => $inscrits_4ans,
        'inscrits_5ans' => $inscrits_5ans,
        'inscrits_1erean' => $inscrits_1erean,
        'inscrits_2emean' => $inscrits_2emean,
        'inscrits_3emean' => $inscrits_3emean,
        'inscrits_4emean' => $inscrits_4emean,
        'inscrits_5emean' => $inscrits_5emean
        ]);
    }

    #[Route('/impression/liste-reinscrits/primaire/3ans', name: 'impression_reinscrits_primaire_3ans')]
    public function impressionRPrimaire3ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3ANS'){
                    array_push($inscrits_3ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_reinscrits_primaire_3ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3ans' => $inscrits_3ans
        ]);
    }

    #[Route('/impression/liste-reinscrits/primaire/4ans', name: 'impression_reinscrits_primaire_4ans')]
    public function impressionRPrimaire4ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_4ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '4ANS'){
                    array_push($inscrits_4ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_reinscrits_primaire_4ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_4ans' => $inscrits_4ans
        ]);
    }

    #[Route('/impression/liste-reinscrits/primaire/5ans', name: 'impression_reinscrits_primaire_5ans')]
    public function impressionRPrimaire5ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_5ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '5ANS'){
                    array_push($inscrits_5ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_reinscrits_primaire_5ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_5ans' => $inscrits_5ans
        ]);
    }

    #[Route('/impression/liste-reinscrits/primaire/1ere-annee', name: 'impression_reinscrits_primaire_1erean')]
    public function impressionRPrimaire1erean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_1erean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '1EREAN'){
                    array_push($inscrits_1erean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_reinscrits_primaire_1erean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_1erean' => $inscrits_1erean
        ]);
    }

    #[Route('/impression/liste-reinscrits/primaire/2eme-annee', name: 'impression_reinscrits_primaire_2emean')]
    public function impressionRPrimaire2emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_2emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '2EMEAN'){
                    array_push($inscrits_2emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_reinscrits_primaire_2emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_2emean' => $inscrits_2emean
        ]);
    }

    #[Route('/impression/liste-reinscrits/primaire/3eme-annee', name: 'impression_reinscrits_primaire_3emean')]
    public function impressionRPrimaire3emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3EMEAN'){
                    array_push($inscrits_3emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_reinscrits_primaire_3emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3emean' => $inscrits_3emean
        ]);
    }

    #[Route('/impression/liste-reinscrits/primaire/4eme-annee', name: 'impression_reinscrits_primaire_4emean')]
    public function impressionRPrimaire4emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_4emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '4EMEAN'){
                    array_push($inscrits_4emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_reinscrits_primaire_4emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_4emean' => $inscrits_4emean
        ]);
    }

    #[Route('/impression/liste-reinscrits/primaire/5eme-annee', name: 'impression_reinscrits_primaire_5emean')]
    public function impressionRPrimaire5emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_5emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP'){

                if($inscrit->getClassePrimaire()->getValeur() == '5EMEAN'){
                    array_push($inscrits_5emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_reinscrits_primaire_5emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_5emean' => $inscrits_5emean
        ]);
    }

    #[Route('/liste-paiement/primaire/tous', name: 'paiements_primaire')]
    public function paiementsPrimaire(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3ans = array();
        $inscrits_4ans = array();
        $inscrits_5ans = array();
        $inscrits_1erean = array();
        $inscrits_2emean = array();
        $inscrits_3emean = array();
        $inscrits_4emean = array();
        $inscrits_5emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3ANS'){
                    array_push($inscrits_3ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '4ANS'){
                    array_push($inscrits_4ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '5ANS'){
                    array_push($inscrits_5ans, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '1EREAN'){
                    array_push($inscrits_1erean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '2EMEAN'){
                    array_push($inscrits_2emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '3EMEAN'){
                    array_push($inscrits_3emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '4EMEAN'){
                    array_push($inscrits_4emean, $inscrit);
                }

                if($inscrit->getClassePrimaire()->getValeur() == '5EMEAN'){
                    array_push($inscrits_5emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/paiements_primaire.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3ans' => $inscrits_3ans,
        'inscrits_4ans' => $inscrits_4ans,
        'inscrits_5ans' => $inscrits_5ans,
        'inscrits_1erean' => $inscrits_1erean,
        'inscrits_2emean' => $inscrits_2emean,
        'inscrits_3emean' => $inscrits_3emean,
        'inscrits_4emean' => $inscrits_4emean,
        'inscrits_5emean' => $inscrits_5emean
        ]);
    }

    #[Route('/impression/liste-paiement/primaire/3ans', name: 'impression_paiement_primaire_3ans')]
    public function impressionPPrimaire3ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3ANS'){
                    array_push($inscrits_3ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_primaire_3ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3ans' => $inscrits_3ans
        ]);
    }

    #[Route('/impression/liste-paiement/primaire/4ans', name: 'impression_paiement_primaire_4ans')]
    public function impressionPPrimaire4ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_4ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '4ANS'){
                    array_push($inscrits_4ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_primaire_4ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_4ans' => $inscrits_4ans
        ]);
    }

    #[Route('/impression/liste-paiement/primaire/5ans', name: 'impression_paiement_primaire_5ans')]
    public function impressionPPrimaire5ans(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_5ans = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '5ANS'){
                    array_push($inscrits_5ans, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_primaire_5ans.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_5ans' => $inscrits_5ans
        ]);
    }

    #[Route('/impression/liste-paiement/primaire/1ere-annee', name: 'impression_paiement_primaire_1erean')]
    public function impressionPPrimaire1erean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_1erean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '1EREAN'){
                    array_push($inscrits_1erean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_primaire_1erean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_1erean' => $inscrits_1erean
        ]);
    }

    #[Route('/impression/liste-paiement/primaire/2eme-annee', name: 'impression_paiement_primaire_2emean')]
    public function impressionPPrimaire2emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_2emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '2EMEAN'){
                    array_push($inscrits_2emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_primaire_2emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_2emean' => $inscrits_2emean
        ]);
    }

    #[Route('/impression/liste-paiement/primaire/3eme-annee', name: 'impression_paiement_primaire_3emean')]
    public function impressionPPrimaire3emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '3EMEAN'){
                    array_push($inscrits_3emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_primaire_3emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_3emean' => $inscrits_3emean
        ]);
    }

    #[Route('/impression/liste-paiement/primaire/4eme-annee', name: 'impression_paiement_primaire_4emean')]
    public function impressionPPrimaire4emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_4emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '4EMEAN'){
                    array_push($inscrits_4emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_primaire_4emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_4emean' => $inscrits_4emean
        ]);
    }

    #[Route('/impression/liste-paiement/primaire/5eme-annee', name: 'impression_paiement_primaire_5emean')]
    public function impressionPPrimaire5emean(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_primaire = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_5emean = array();

        foreach($inscrits_primaire as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'RSP' || $inscrit->getCarnet()->getGroupe() == 'ISP'){

                if($inscrit->getClassePrimaire()->getValeur() == '5EMEAN'){
                    array_push($inscrits_5emean, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_primaire_5emean.html.twig', [
        'inscrits_primaire' => $inscrits_primaire,
        'inscrits_5emean' => $inscrits_5emean
        ]);
    }

    #[Route('/liste-paiement/college/tous', name: 'paiements_college')]
    public function paiementsCollege(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_6eme = array();
        $inscrits_5eme = array();
        $inscrits_4eme = array();
        $inscrits_3eme = array();
        $inscrits_2ndes = array();
        $inscrits_2ndele = array();
        $inscrits_1eres = array();
        $inscrits_1erele = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '6EME'){
                    array_push($inscrits_6eme, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '5EME'){
                    array_push($inscrits_5eme, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '4EME'){
                    array_push($inscrits_4eme, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '3EME'){
                    array_push($inscrits_3eme, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '2NDES'){
                    array_push($inscrits_2ndes, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '2NDELE'){
                    array_push($inscrits_2ndele, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '1ERES'){
                    array_push($inscrits_1eres, $inscrit);
                }

                if($inscrit->getClasseCollege()->getValeur() == '1ERELE'){
                    array_push($inscrits_1erele, $inscrit);
                }

            }
        }
        return $this->render('carnet/paiements_college.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_6eme' => $inscrits_6eme,
        'inscrits_5eme' => $inscrits_5eme,
        'inscrits_5eme' => $inscrits_4eme,
        'inscrits_3eme' => $inscrits_3eme,
        'inscrits_2ndes' => $inscrits_2ndes,
        'inscrits_2ndele' => $inscrits_2ndele,
        'inscrits_1eres' => $inscrits_1eres,
        'inscrits_1erele' => $inscrits_1erele,
        ]);
    }

    #[Route('/impression/liste-paiement/college/6eme', name: 'impression_paiement_college_6eme')]
    public function impressionPCollege6eme(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_6eme = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '6EME'){
                    array_push($inscrits_6eme, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_college_6eme.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_6eme' => $inscrits_6eme
        ]);
    }

    #[Route('/impression/liste-paiement/college/5eme', name: 'impression_paiement_college_5eme')]
    public function impressionPCollege5eme(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_5eme = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '5EME'){
                    array_push($inscrits_5eme, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_college_5eme.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_5eme' => $inscrits_5eme
        ]);
    }

    #[Route('/impression/liste-paiement/college/4eme', name: 'impression_paiement_college_4eme')]
    public function impressionPCollege4eme(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_4eme = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '4EME'){
                    array_push($inscrits_4eme, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_college_4eme.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_4eme' => $inscrits_4eme
        ]);
    }

    #[Route('/impression/liste-paiement/college/3eme', name: 'impression_paiement_college_3eme')]
    public function impressionPCollege3eme(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_3eme = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '3EME'){
                    array_push($inscrits_3eme, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_college_3eme.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_3eme' => $inscrits_3eme
        ]);
    }

    #[Route('/impression/liste-paiement/college/2nde-S', name: 'impression_paiement_college_2ndes')]
    public function impressionPCollege2ndes(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_2ndes = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '2NDES'){
                    array_push($inscrits_2ndes, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_college_2ndes.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_2ndes' => $inscrits_2ndes
        ]);
    }

    #[Route('/impression/liste-paiement/college/2nde-LE', name: 'impression_paiement_college_2nde-le')]
    public function impressionPCollege2ndele(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_2ndele = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '2NDELE'){
                    array_push($inscrits_2ndele, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_college_2ndele.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_2ndele' => $inscrits_2ndele
        ]);
    }

    #[Route('/impression/liste-paiement/college/1ere-S', name: 'impression_paiement_college_1eres')]
    public function impressionPCollege1eres(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_1eres = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '1ERES'){
                    array_push($inscrits_1eres, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_college_1eres.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_1eres' => $inscrits_1eres
        ]);
    }

    #[Route('/impression/liste-paiement/college/1ere-LE', name: 'impression_paiement_college_1erele')]
    public function impressionPCollege1erele(InscriptionRepository $inscritsRepository): Response
    {   $inscrits_college = $inscritsRepository->findBy([],['nom' => 'ASC']);
        $inscrits_1erele = array();

        foreach($inscrits_college as $inscrit)
        {
            if($inscrit->getCarnet()->getGroupe() == 'ISC'){

                if($inscrit->getClasseCollege()->getValeur() == '1ERELE'){
                    array_push($inscrits_1erele, $inscrit);
                }

            }
        }
        return $this->render('carnet/impression_paiement_college_1erele.html.twig', [
        'inscrits_college' => $inscrits_college,
        'inscrits_1erele' => $inscrits_1erele
        ]);
    }
}
