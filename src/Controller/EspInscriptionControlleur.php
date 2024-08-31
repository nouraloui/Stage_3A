<?php

namespace App\Controller;

use App\Entity\EspInscription;
use App\Entity\EspEtudiant;
use App\Form\EspInscriptionType;
use App\Repository\EspInscriptionRepository;
use App\Repository\EspEtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ClasseSearchType;
use App\Service\PdfService;
use Symfony\Component\HttpFoundation\JsonResponse;

use Twig\Environment;

#[Route('/inscription')]


class EspInscriptionControlleur extends AbstractController
{
    #[Route('/', name: 'app_inscription_index', methods: ['GET', 'POST'])]
    public function index(EspEtudiantRepository $espEtudiantRepository): Response
    {
        
        return $this->render('inscription/index.html.twig', [
            'etudiantds' => $espEtudiantRepository->findAll(),
        ]);
    }
  
    #[Route('/search/{id}', name: 'app_inscription_search')]
    public function search(string $id,Request $request, EspInscriptionRepository $espInscriptionRepository, Environment $twig): Response
    {
        $searchTerm = $request->request->get('searchTerm');
        if($searchTerm!==null|| $searchTerm!==0){
            $result = $espInscriptionRepository->search($searchTerm,$id);
            return new Response($twig->render('inscription/search_list.html.twig', ['espInscriptions' => $result]));
        }
        else{
            $result=$espInscriptionRepository->createQueryBuilder('e')
            ->where('e.etudiant.id LIKE :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
            return new Response($twig->render('inscription/search_list.html.twig', ['espInscriptions' => $result]));
        }
        
    }


    #[Route('/new', name: 'app_inscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EspEtudiantRepository $espEtudiantRepository): Response
    {
        $espInscription = new EspInscription();
        $form = $this->createForm(EspInscriptionType::class, $espInscription);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant = $espEtudiantRepository->find($form->get('etudiant')->getData());
    
            if ($etudiant === null) {
                $this->addFlash('error', 'Étudiant introuvable.');
                return $this->redirectToRoute('app_inscription_new');
            }
    
            $etudiant->setInscription(true);
    
            try {
                $entityManager->persist($espInscription);
                $entityManager->persist($etudiant);
                $entityManager->flush();
    
                $this->addFlash('success', 'Inscription créée avec succès.');
                return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur lors de la création de l\'inscription.');
            }
        }
    
        return $this->renderForm('inscription/new.html.twig', [
            'espInscription' => $espInscription,
            'form' => $form,
        ]);
    }
    
//show
#[Route('/show/{id}', name: 'app_inscription_show', methods: ['GET'])]
public function show(string $id, EspInscriptionRepository $espInscriptionRepository): Response
{
    $espInscription = $espInscriptionRepository->findOneById($id);

    if (!$espInscription) {
        throw $this->createNotFoundException('inscription not found');
    }

    return $this->render('inscription/show.html.twig', [
        'espInscription' => $espInscription,
    ]);
}
//edit
    #[Route('/{id}/edit', name: 'app_inscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EspInscription $espInscription, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EspInscriptionType::class, $espInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscription/edit.html.twig', [
            'espInscription' => $espInscription,
            'form' => $form,
        ]);
    }
//delete
#[Route('/delete/{id}', name: 'app_inscription_delete', methods: ['POST'])]
public function delete(Request $request, EspInscription $spInscription, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('delete' . $spInscription->getId(), $request->request->get('_token'))) {
        $entityManager->remove($spInscription);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
}

    //pdf
   
   
    #[Route('/pdf/{id}/{mode}', name: 'app_inscription_pdf', methods: ['GET'])]
public function pdf(string $id, string $mode, PdfService $pdfService, Request $request, EspInscriptionRepository $espInscriptionRepository): Response
{
    $inscription = $espInscriptionRepository->createQueryBuilder('i')
        ->leftJoin('i.etudiant', 'e')
        ->leftJoin('e.photo', 'p')
        ->where('i.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getOneOrNullResult();

    if (!$inscription) {
        throw $this->createNotFoundException('Inscription not found.');
    }

    if ($inscription && $inscription->getEtudiant()->getPhoto()) {
        $photoData = base64_encode(stream_get_contents($inscription->getEtudiant()->getPhoto()->getPhotosId()));
        $inscription->getEtudiant()->getPhoto()->setPhotosId($photoData);
    }

    $logoPath = $this->getParameter('kernel.project_dir') . '/public/espritng.png';
    $logoBase64 = $this->imageToBase64($logoPath);
    $autre = $this->getParameter('kernel.project_dir') . '/public/49152.png';
    $autreBase64 = $this->imageToBase64($autre);

    switch ($mode) {
        case "carte":
            $html = $this->renderView('inscription/carte.html.twig', [
                'inscription' => $inscription,
                'logoBase64' => $logoBase64,
                'autreBase64' => $autreBase64,
            ]);
            $filename = 'carte_etudiant.pdf';
            break;

        case "attestation":
            $html = $this->renderView('inscription/attestation.html.twig', [
                'inscription' => $inscription,
                'logoBase64' => $logoBase64,
                'autreBase64' => $autreBase64,
            ]);
            $filename = 'attestation_inscription.pdf';
            break;

        case "resultat":
            $html = $this->renderView('inscription/resultat.html.twig', [
                'inscription' => $inscription,
                'logoBase64' => $logoBase64,
                'autreBase64' => $autreBase64,
            ]);
            $filename = 'resultat.pdf';
            break;

        default:
            throw $this->createNotFoundException('Invalid mode.');
    }

    $pdfContent = $pdfService->generatePdf($html);

    return new Response($pdfContent, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
    ]);
}

function imageToBase64($path) {
    $imageData = file_get_contents($path);
    $base64 = base64_encode($imageData);
    return 'data:image/png;base64,' . $base64;
}


   
    

}


   




    

    




