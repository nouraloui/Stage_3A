<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utilisateur')]
class UtilisateurController extends AbstractController
{
    #[Route('/index', name: 'app_utilisateur_index', methods: ['GET'])]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAll(),
        ]);
    }
  
    #[Route('/login', name: 'app_utilisateur_login')]
    public function login(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $adresse = trim($request->request->get('utilisateur'));
            $password = md5(trim($request->request->get('mot_de_passe'))); // Match the new name here
    
            // Retrieve the user based on the adresse
            $user = $entityManager->getRepository(Utilisateur::class)->findOneBy(['adresse' => $adresse]);
    
        
    
            // Check if the user exists and if the password matches
            if ($user && $user->getMdp() === $password) {
                // Log the user in and redirect
                return $this->redirectToRoute('app_dash');
            } else {
                // Set an error message
                $this->addFlash('error', 'Invalid adresse or password');
            }
        }
        return $this->redirectToRoute('app_classe');
    }
    
    #[Route('/forget', name: 'app_utilisateur_forget')]
    public function forget(Request $request, EntityManagerInterface $entityManager): Response
    {
         
        return $this->render('utilisateur/forget_password.html.twig');
    }



    #[Route('/new', name: 'app_utilisateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


 // Handle the image upload
 $imageFile = $form->get('image')->getData();

 if ($imageFile) {
     // Generate a unique filename
     $newFilename = uniqid() . '.' . $imageFile->guessExtension();

     // Move the file to the directory where images are stored
     $imageFile->move($this->getParameter('images_directory'), $newFilename);

     // Set the image name in the entity
     $utilisateur->setImage($newFilename); // Save only the image name
 }

 $mdp = $form->get('mdp')->getData();
 $hashedMdp = md5($mdp);
 $utilisateur->setMdp($hashedMdp);
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_utilisateur_show', methods: ['GET'])]
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_utilisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
    
   
    
}