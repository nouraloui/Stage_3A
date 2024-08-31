<?php

namespace App\Controller;
use Twig\Environment;
use App\Entity\EspSaisonUniversitaire;
use App\Form\EspSaisonUniversitaireType;
use App\Repository\EspSaisonUniversitaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
#[Route('/esp/saison/universitaire')]
class EspSaisonUniversitaireController extends AbstractController
{
    #[Route('/', name: 'app_esp_saison_universitaire_index', methods: ['GET'])]
    public function index(EspSaisonUniversitaireRepository $espSaisonUniversitaireRepository): Response
    {
        return $this->render('esp_saison_universitaire/index.html.twig', [
            'esp_saison_universitaires' => $espSaisonUniversitaireRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'app_esp_saison_universitaire_index', methods: ['GET'])]
    public function tri(Request $request, EspSaisonUniversitaireRepository $espSaisonUniversitaireRepository): Response
    {
        $sortField = $request->query->get('sortField', 'description'); 
        $sortOrder = $request->query->get('sortOrder', 'asc');

        $esp_saison_universitaires = $espSaisonUniversitaireRepository->findAllSortedBy($sortField, $sortOrder);

        return $this->render('esp_saison_universitaire/index.html.twig', [
            'esp_saison_universitaires' => $esp_saison_universitaires,
        ]);
    }

    #[Route('/search', name: 'app_searchuni')]
    public function search(Request $request, EspSaisonUniversitaireRepository $espSaisonUniversitaireRepository, Environment $twig): Response
    {
        $searchTerm = $request->request->get('searchTerm');
        $result = $espSaisonUniversitaireRepository->search($searchTerm); 
        return new Response($twig->render('esp_saison_universitaire/search_list.html.twig', ['esp_saison_universitaires' => $result]));
    }
    #[Route('/new', name: 'app_esp_saison_universitaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espSaisonUniversitaire = new EspSaisonUniversitaire();
        $form = $this->createForm(EspSaisonUniversitaireType::class, $espSaisonUniversitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espSaisonUniversitaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_saison_universitaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_saison_universitaire/new.html.twig', [
            'esp_saison_universitaire' => $espSaisonUniversitaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_esp_saison_universitaire_show', methods: ['GET'])]
    public function show(EspSaisonUniversitaire $espSaisonUniversitaire): Response
    {
        return $this->render('esp_saison_universitaire/show.html.twig', [
            'esp_saison_universitaire' => $espSaisonUniversitaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_esp_saison_universitaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EspSaisonUniversitaire $espSaisonUniversitaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EspSaisonUniversitaireType::class, $espSaisonUniversitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_saison_universitaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_saison_universitaire/edit.html.twig', [
            'esp_saison_universitaire' => $espSaisonUniversitaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_esp_saison_universitaire_delete', methods: ['POST'])]
    public function delete(Request $request, EspSaisonUniversitaire $espSaisonUniversitaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espSaisonUniversitaire->getAnneeDeb(), $request->request->get('_token'))) {
            $entityManager->remove($espSaisonUniversitaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_esp_saison_universitaire_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/generate-csrf-token/{intention}', name: 'generate_csrf_token', methods: ['POST'])]
    public function generateCsrfToken(string $intention, CsrfTokenManagerInterface $csrfTokenManager): JsonResponse
    {
        // Generate a CSRF token for the given intention
        $csrfToken = $csrfTokenManager->getToken($intention)->getValue();

        // Return the token in a JSON response
        return new JsonResponse(['csrf_token' => $csrfToken]);
    }

    #[Route('/saison/{id}', name: 'app_get_saisons', methods: ['GET'])]
public function getSaisons(EspSaisonUniversitaire $espSaisonUniversitaire): JsonResponse
{
    $saisons = $espSaisonUniversitaire->getSaisons();

    $saisonArray = [];

    foreach ($saisons as $saison) {
        $saisonArray[] = [
            'id' => $saison->getId(),
            'codeClasse' => $saison->getCodeCl(),
            'dateDemarrage' => $saison->getDateDemarrage()->format('Y-m-d'),
            'anneeDebut' => $saison->getAnneeDeb(),
        ];
    }

    return new JsonResponse($saisonArray);
}

}
