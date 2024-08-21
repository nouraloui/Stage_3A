<?php

/*namespace App\Controller;

use App\Entity\Compteur;
use App\Form\CompteurType;
use App\Repository\CompteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compteur')]
class CompteurController extends AbstractController
{
    #[Route('/', name: 'app_compteur_index', methods: ['GET'])]
    public function index(CompteurRepository $compteurRepository): Response
    {
        return $this->render('compteur/index.html.twig', [
            'compteurs' => $compteurRepository->findAll(),
        ]);
    }




#[Route('/compteur/new', name: 'app_compteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $compteur = new Compteur();
        $form = $this->createForm(CompteurType::class, $compteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($compteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compteur/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    #[Route('/{id}', name: 'app_compteur_show', methods: ['GET'])]
    public function show(Compteur $compteur): Response
    {
        return $this->render('compteur/show.html.twig', [
            'compteur' => $compteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Compteur $compteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompteurType::class, $compteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compteur/edit.html.twig', [
            'compteur' => $compteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compteur_delete', methods: ['POST'])]
    public function delete(Request $request, Compteur $compteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($compteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
    }
    
}*/

// src/Controller/CompteurController.php
/*
namespace App\Controller;

use App\Entity\Compteur;
use App\Form\CompteurType;
use App\Repository\CompteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compteur')]
class CompteurController extends AbstractController
{
    #[Route('/', name: 'app_compteur_index', methods: ['GET'])]
    public function index(CompteurRepository $compteurRepository): Response
    {
        return $this->render('compteur/index.html.twig', [
            'compteurs' => $compteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_compteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $compteur = new Compteur();
        $form = $this->createForm(CompteurType::class, $compteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($compteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compteur/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_compteur_show', methods: ['GET'])]
    public function show(Compteur $compteur): Response
    {
        return $this->render('compteur/show.html.twig', [
            'compteur' => $compteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Compteur $compteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompteurType::class, $compteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compteur/edit.html.twig', [
            'compteur' => $compteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compteur_delete', methods: ['POST'])]
    public function delete(Request $request, Compteur $compteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($compteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
    }
    
}*/














// src/Controller/CompteurController.php

namespace App\Controller;

use App\Entity\Compteur;
use App\Form\CompteurType;
use App\Repository\CompteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compteur')]
class CompteurController extends AbstractController
{
    #[Route('/', name: 'app_compteur_index', methods: ['GET'])]
    public function index(Request $request, CompteurRepository $compteurRepository): Response
    {
        $searchTerm = $request->query->get('search', '');

        $sort = $request->query->get('sort', 'id');
        $direction = $request->query->get('direction', 'asc');

        $validSortFields = ['id', 'code_cpt', 'lib_cpt', 'date_cr', 'date_last_modif', 'taille', 'valeur'];
        if (!in_array($sort, $validSortFields)) {
            $sort = 'id';
        }
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $queryBuilder = $compteurRepository->createQueryBuilder('c')
            ->where('c.code_cpt LIKE :searchTerm OR c.lib_cpt LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$searchTerm.'%')
            ->orderBy('c.' . $sort, $direction);

        $compteurs = $queryBuilder->getQuery()->getResult();

        return $this->render('compteur/index.html.twig', [
            'compteurs' => $compteurs,
            'sort' => $sort,
            'direction' => $direction,
            'search' => $searchTerm,
        ]);
    }

    #[Route('/new', name: 'app_compteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $compteur = new Compteur();
        $form = $this->createForm(CompteurType::class, $compteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($compteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compteur/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_compteur_show', methods: ['GET'])]
    public function show(Compteur $compteur): Response
    {
        return $this->render('compteur/show.html.twig', [
            'compteur' => $compteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Compteur $compteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompteurType::class, $compteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compteur/edit.html.twig', [
            'compteur' => $compteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compteur_delete', methods: ['POST'])]
    public function delete(Request $request, Compteur $compteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($compteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_compteur_index', [], Response::HTTP_SEE_OTHER);
    }
}

