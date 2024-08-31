<?php

namespace App\Controller;

use App\Entity\EspPlanEtude;
use App\Form\EspPlanEtudeType;
use App\Repository\EspPlanEtudeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
#[Route('/esp/plan/etude')]
class EspPlanEtudeController extends AbstractController
{
    #[Route('/', name: 'planEtudeIndex', methods: ['GET'])]
    public function index(EspPlanEtudeRepository $espPlanEtudeRepository): Response 
    {
        return $this->render('esp_plan_etude/AFFICHAGE.html.twig', [
            'esp_plan_etudes' => $espPlanEtudeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'planEtudeNew', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espPlanEtude = new EspPlanEtude();
        $form = $this->createForm(EspPlanEtudeType::class, $espPlanEtude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espPlanEtude);
            $entityManager->flush();

            return $this->redirectToRoute('planEtudeIndex', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_plan_etude/new.html.twig', [
            'esp_plan_etude' => $espPlanEtude,
            'form' => $form,
        ]);
    }

    #[Route('/{code_module}', name: 'planEtudeShow', methods: ['GET'])]
    public function show(EspPlanEtude $espPlanEtude): Response
    {
        return $this->render('esp_plan_etude/show.html.twig', [
            'esp_plan_etude' => $espPlanEtude,
        ]);
    }

    
    #[Route('/{code_module}/edit', name: 'planEtudeEdit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager,
        string $code_module
    ): Response {
        $espPlanEtude = $entityManager->getRepository(EspPlanEtude::class)->find($code_module);

        if (!$espPlanEtude) {
            throw $this->createNotFoundException('No EspPlanEtude found for code_module ' . $code_module);
        }

        $form = $this->createForm(EspPlanEtudeType::class, $espPlanEtude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('planEtudeIndex', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_plan_etude/edit.html.twig', [
            'esp_plan_etude' => $espPlanEtude,
            'form' => $form,
        ]);
    }


    #[Route('/{code_module}/delete', name: 'planEtudeDelete', methods: ['POST'])]
    public function delete(
        Request $request,
        EntityManagerInterface $entityManager,
        string $code_module
    ): RedirectResponse {
        $espPlanEtude = $entityManager->getRepository(EspPlanEtude::class)->find($code_module);

        if (!$espPlanEtude) {
            throw $this->createNotFoundException('No EspPlanEtude found for code_module ' . $code_module);
        }

        if ($this->isCsrfTokenValid('delete' . $code_module, $request->request->get('_token'))) {
            $entityManager->remove($espPlanEtude);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planEtudeIndex', [], Response::HTTP_SEE_OTHER);
    }
}
