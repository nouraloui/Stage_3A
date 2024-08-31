<?php

namespace App\Controller;

use App\Entity\EspEnseignant;
use App\Form\EspEnseignantType;
use App\Repository\EspEnseignantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/esp/enseignant')]
class EspEnseignantController extends AbstractController
{
    #[Route('/', name: 'app_esp_enseignant_index', methods: ['GET'])]
    public function index(EspEnseignantRepository $espEnseignantRepository): Response
    {
        return $this->render('esp_enseignant/index.html.twig', [
            'esp_enseignants' => $espEnseignantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_esp_enseignant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espEnseignant = new EspEnseignant();
        $form = $this->createForm(EspEnseignantType::class, $espEnseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espEnseignant);
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_enseignant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_enseignant/new.html.twig', [
            'esp_enseignant' => $espEnseignant,
            'form' => $form,
        ]);
    }

    #[Route('/{id_ens}', name: 'app_esp_enseignant_show', methods: ['GET'])]
    public function show(EspEnseignant $espEnseignant): Response
    {
        return $this->render('esp_enseignant/show.html.twig', [
            'esp_enseignant' => $espEnseignant,
        ]);
    }

    #[Route('/{id_ens}/edit', name: 'app_esp_enseignant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EspEnseignant $espEnseignant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EspEnseignantType::class, $espEnseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_enseignant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_enseignant/edit.html.twig', [
            'esp_enseignant' => $espEnseignant,
            'form' => $form,
        ]);
    }

    #[Route('/{id_ens}', name: 'app_esp_enseignant_delete', methods: ['POST'])]
    public function delete(Request $request, EspEnseignant $espEnseignant = null, EntityManagerInterface $entityManager): Response
    {
        // Check if the entity was found
        if (!$espEnseignant) {
            throw $this->createNotFoundException('No teacher found for id '.$request->attributes->get('id_ens'));
        }
    
        // CSRF token validation
        if ($this->isCsrfTokenValid('delete'.$espEnseignant->getIdEns(), $request->request->get('_token'))) {
            $entityManager->remove($espEnseignant);
            $entityManager->flush();
        } else {
            $this->addFlash('error', 'Invalid CSRF token.');
        }
    
        return $this->redirectToRoute('app_esp_enseignant_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
