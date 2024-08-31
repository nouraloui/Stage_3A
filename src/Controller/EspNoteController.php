<?php

namespace App\Controller;

use App\Entity\EspNote;
use App\Form\EspNoteType;
use App\Repository\EspNoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/esp/note')]
class EspNoteController extends AbstractController
{
    #[Route('/', name: 'app_esp_note_index', methods: ['GET'])]
    public function index(EspNoteRepository $espNoteRepository): Response
    {
        return $this->render('esp_note/index.html.twig', [
            'esp_notes' => $espNoteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_esp_note_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espNote = new EspNote();
        $form = $this->createForm(EspNoteType::class, $espNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espNote);
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_note/new.html.twig', [
            'esp_note' => $espNote,
            'form' => $form,
        ]);
    }

    #[Route('/{code_module}', name: 'app_esp_note_show', methods: ['GET'])]
    public function show(EspNote $espNote): Response
    {
        return $this->render('esp_note/show.html.twig', [
            'esp_note' => $espNote,
        ]);
    }

    #[Route('/{code_module}/edit', name: 'app_esp_note_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EspNote $espNote, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EspNoteType::class, $espNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_note/edit.html.twig', [
            'esp_note' => $espNote,
            'form' => $form,
        ]);
    }

    #[Route('/{code_module}', name: 'app_esp_note_delete', methods: ['POST'])]
    public function delete(Request $request, EspNote $espNote, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espNote->getCodeModule(), $request->request->get('_token'))) {
            $entityManager->remove($espNote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_esp_note_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{code_module}/confirm', name: 'note_confirm', methods: ['GET', 'POST'])]
    public function confirm(EspNote $espNote, EntityManagerInterface $entityManager): Response
{
    if (!$espNote->getIsConfirmed()) {
        $espNote->setIsConfirmed(true);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_esp_note_index');
}

}
