<?php

namespace App\Controller;

use App\Entity\EspContrat;
use App\Form\EspContratType;
use App\Repository\EspContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/esp/contrat')]
class EspContratController extends AbstractController
{
    #[Route('/', name: 'app_esp_contrat_index', methods: ['GET'])]
    public function index(EspContratRepository $espContratRepository): Response
    {
        return $this->render('esp_contrat/index.html.twig', [
            'esp_contrats' => $espContratRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_esp_contrat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espContrat = new EspContrat();
        $form = $this->createForm(EspContratType::class, $espContrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espContrat);
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_contrat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_contrat/new.html.twig', [
            'esp_contrat' => $espContrat,
            'form' => $form,
        ]);
    }

    #[Route('/{numord}', name: 'app_esp_contrat_show', methods: ['GET'])]
    public function show(EspContrat $espContrat): Response
    {
        // Ensure $espContrat is correctly fetched
        return $this->render('esp_contrat/show.html.twig', [
            'esp_contrat' => $espContrat,
        ]);
    }
    

    #[Route('/{numord}/edit', name: 'app_esp_contrat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $numord, EntityManagerInterface $entityManager): Response
    {
        $espContrat = $entityManager->getRepository(EspContrat::class)->findOneBy(['numord' => $numord]);
    
        if (!$espContrat) {
            throw $this->createNotFoundException('No contract found for numord '.$numord);
        }
    
        $form = $this->createForm(EspContratType::class, $espContrat);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_esp_contrat_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('esp_contrat/edit.html.twig', [
            'esp_contrat' => $espContrat,
            'form' => $form,
        ]);
    }
    

    #[Route('/{numord}', name: 'app_esp_contrat_delete', methods: ['POST'])]
    public function delete(Request $request, EspContrat $espContrat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $espContrat->getNumord(), $request->request->get('_token'))) {
            $entityManager->remove($espContrat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_esp_contrat_index', [], Response::HTTP_SEE_OTHER);
    }
}
