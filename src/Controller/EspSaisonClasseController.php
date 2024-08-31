<?php

namespace App\Controller;

use App\Entity\EspSaisonClasse;
use App\Form\EspSaisonClasseType;
use App\Repository\EspSaisonClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/esp/saison/classe')]
class EspSaisonClasseController extends AbstractController
{
    #[Route('/', name: 'app_esp_saison_classe_index', methods: ['GET'])]
    public function index(EspSaisonClasseRepository $espSaisonClasseRepository): Response
    {
        return $this->render('esp_saison_classe/index.html.twig', [
            'esp_saison_classes' => $espSaisonClasseRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'app_esp_saison_classe_index', methods: ['GET'])]
    public function tri(Request $request, EspSaisonClasseRepository $espSaisonClasseRepository): Response
    {
        $sortField = $request->query->get('sortField', 'code_cl'); 
        $sortOrder = $request->query->get('sortOrder', 'asc'); 

        $esp_saison_classes = $espSaisonClasseRepository->findAllSortedBy($sortField, $sortOrder);

        return $this->render('esp_saison_classe/index.html.twig', [
            'esp_saison_classes' => $esp_saison_classes,
        ]);
    }
    #[Route('/search', name: 'app_searchSaison')]
    public function search(Request $request, EspSaisonClasseRepository $espSaisonClasseRepository, Environment $twig): Response
    {
        $searchTerm = $request->request->get('searchTerm');
        $result = $espSaisonClasseRepository->search($searchTerm); 
        return new Response($twig->render('esp_saison_classe/search_list.html.twig', ['esp_saison_classes' => $result]));
    }

    #[Route('/new', name: 'app_esp_saison_classe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espSaisonClasse = new EspSaisonClasse();
        $form = $this->createForm(EspSaisonClasseType::class, $espSaisonClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espSaisonClasse);
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_saison_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_saison_classe/new.html.twig', [
            'esp_saison_classe' => $espSaisonClasse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_esp_saison_classe_show', methods: ['GET'])]
    public function show(EspSaisonClasse $espSaisonClasse): Response
    {
        return $this->render('esp_saison_classe/show.html.twig', [
            'esp_saison_classe' => $espSaisonClasse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_esp_saison_classe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EspSaisonClasse $espSaisonClasse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EspSaisonClasseType::class, $espSaisonClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_saison_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_saison_classe/edit.html.twig', [
            'esp_saison_classe' => $espSaisonClasse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_esp_saison_classe_delete', methods: ['POST'])]
    public function delete(Request $request, EspSaisonClasse $espSaisonClasse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espSaisonClasse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($espSaisonClasse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_esp_saison_classe_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/classe/{id}', name: 'app_get_classes', methods: ['GET'])]
    public function getClasses(EspSaisonClasse $espSaisonClasse): JsonResponse
    {
        $classes = $espSaisonClasse->getClasses();
        
        $classeArray = [];
        foreach ($classes as $classe) {
            if ($classe->isOuvert()) {
                $classeArray[] = [
                    'id' => $classe->getId(),
                    'categorie' => $classe->getCatergorie(),
                    'filiere' => $classe->getFiliere(),
                ];
            }
        }
    
        return new JsonResponse($classeArray);
    }
    
}
