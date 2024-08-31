<?php

namespace App\Controller;

use App\Entity\EspEnteteNote;
use App\Form\EspEnteteNoteType;
use App\Repository\EspEnteteNoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/esp/entete/note')]
class EspEnteteNoteController extends AbstractController
{
    #[Route('/', name: 'app_esp_entete_note_index', methods: ['GET'])]
    public function index(EspEnteteNoteRepository $espEnteteNoteRepository): Response
    {
        return $this->render('esp_entete_note/index.html.twig', [
            'esp_entete_notes' => $espEnteteNoteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_esp_entete_note_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espEnteteNote = new EspEnteteNote();
        $form = $this->createForm(EspEnteteNoteType::class, $espEnteteNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espEnteteNote);
            $entityManager->flush();

            return $this->redirectToRoute('app_esp_entete_note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('esp_entete_note/new.html.twig', [
            'esp_entete_note' => $espEnteteNote,
            'form' => $form,
        ]);
    }

    #[Route('/{code_module}', name: 'app_esp_entete_note_show', methods: ['GET'])]
    public function show(EspEnteteNote $espEnteteNote): Response
    {
        return $this->render('esp_entete_note/show.html.twig', [
            'esp_entete_note' => $espEnteteNote,
        ]);
    }

    #[Route('/{code_module}/edit', name: 'app_esp_entete_note_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EspEnteteNoteRepository $espEnteteNoteRepository, EntityManagerInterface $entityManager, string $code_module): Response
    {
        // Use the correct field name as per your entity
        $espEnteteNote = $espEnteteNoteRepository->findOneBy(['code_module' => $code_module]);
    
        if (!$espEnteteNote) {
            throw $this->createNotFoundException('No EspEnteteNote found for code_module ' . $code_module);
        }
    
        $form = $this->createForm(EspEnteteNoteType::class, $espEnteteNote);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_esp_entete_note_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('esp_entete_note/edit.html.twig', [
            'esp_entete_note' => $espEnteteNote,
            'form' => $form,
        ]);
    }
    
    


#[Route('/{code_module}', name: 'app_esp_entete_note_delete', methods: ['POST'])]
public function delete(Request $request, EspEnteteNote $espEnteteNote, EntityManagerInterface $entityManager): Response
{
   if ($this->isCsrfTokenValid('delete' . $espEnteteNote->getCodeModule(), $request->request->get('_token'))) {
    $entityManager->remove($espEnteteNote);
    $entityManager->flush();
}


    return $this->redirectToRoute('app_esp_entete_note_index', [], Response::HTTP_SEE_OTHER);
}
#[Route('/TrierParDateDESC', name: 'TrierParDateDESC', methods: ['GET'])]
public function TrierParDate(EspEnteteNoteRepository $repository): Response
{
    // Supposez que vous ayez une méthode `findByDateDesc` dans votre repository
    $espEnteteNotes = $repository->findBy([], ['DateSaisie' => 'DESC']);

    return $this->render('esp_entete_note/index.html.twig', [
        'esp_entete_notes' => $espEnteteNotes,
    ]);
}

}
