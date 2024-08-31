<?php

namespace App\Controller;


use App\Entity\EspModule;
use App\Form\EspModuleType;
use App\Repository\EspModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/esp/module')]
class EspModuleController extends AbstractController
{
    
    #[Route('/', name: 'app_esp_module_index', methods: ['GET'])]
        public function index(EspModuleRepository $espModuleRepository): Response
        {
            return $this->render('esp_module/index.html.twig', [
                'esp_modules' => $espModuleRepository->findAll(),
            ]);
        }
    

    #[Route('/new', name: 'app_esp_module_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espModule = new EspModule();
        $form = $this->createForm(EspModuleType::class, $espModule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espModule);
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_module_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_module/new.html.twig', [
            'esp_module' => $espModule,
            'form' => $form,
        ]);
    }

    #[Route('/{code_module}', name: 'app_esp_module_show', methods: ['GET'])]
    public function show(EspModule $espModule): Response
    {
        return $this->render('esp_module/show.html.twig', [
            'esp_module' => $espModule,
        ]);
    }

    #[Route('/{code_module}/edit', name: 'app_esp_module_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EspModule $espModule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EspModuleType::class, $espModule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_module_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_module/edit.html.twig', [
            'esp_module' => $espModule,
            'form' => $form,
        ]);
    }

    #[Route('/{code_module}', name: 'app_esp_module_delete', methods: ['POST'])]
    public function delete(Request $request, EspModule $espModule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espModule->getCodeModule(), $request->request->get('_token'))) {
            $entityManager->remove($espModule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_esp_module_index', [], Response::HTTP_SEE_OTHER);
    }
    
}