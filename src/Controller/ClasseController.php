<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\EspEtudiant;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
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

#[Route('/classe')]


class ClasseController extends AbstractController
{
    #[Route('/', name: 'app_classe_index', methods: ['GET'])]
    public function index(ClasseRepository $classeRepository): Response
    {
        return $this->render('classe/index.html.twig', [
            'classes' => $classeRepository->findAll(),
        ]);
    }
  
    #[Route('/search', name: 'app_searchClasse')]
    public function search(Request $request, ClasseRepository $classeRepository, Environment $twig): Response
    {
        $searchTerm = $request->request->get('searchTerm');
        $result = $classeRepository->search($searchTerm); 
        return new Response($twig->render('classe/search_list.html.twig', ['classes' => $result]));
    }

    public function index1(Request $request): Response
    {
        $form = $this->createForm(ClasseType::class); // Remplacez 'ClasseType' par votre type de formulaire

        // Traitement du formulaire si nécessaire
        $form->handleRequest($request);

        // Récupération des classes (exemple)
        $classes = []; // Remplacez par votre logique pour récupérer les classes

        return $this->render('classe/index.html.twig', [
            'form' => $form->createView(), // Passez le formulaire au template
            'classes' => $classes,
        ]);
    }

    #[Route('/new', name: 'app_classe_new', methods: ['GET', 'POST'])]
    
    //new
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($classe);
            $entityManager->flush();

            return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classe/new.html.twig', [
            'classe' => $classe,
            'form' => $form,
        ]);
    }
//show
#[Route('/show/{id}', name: 'app_classe_show', methods: ['GET'])]
public function show(string $id, ClasseRepository $classeRepository): Response
{
    // Utilisation de la méthode findOneByCodeCl pour trouver la classe par code_cl
    $classe = $classeRepository->findOneById($id);

    if (!$classe) {
        throw $this->createNotFoundException('Classe not found');
    }

    return $this->render('classe/show.html.twig', [
        'classe' => $classe,
    ]);
}
//edit
    #[Route('/{id}/edit', name: 'app_classe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Classe $classe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classe/edit.html.twig', [
            'classe' => $classe,
            'form' => $form,
        ]);
    }
//delete
#[Route('/delete/{id}', name: 'app_classe_delete', methods: ['POST'])]
public function delete(Request $request, Classe $classe, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('delete' . $classe->getId(), $request->request->get('_token'))) {
        $entityManager->remove($classe);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
}
//search
   
//tri

    #[Route('/', name: 'app_classe_index', methods: ['GET'])]
    public function tri(Request $request, ClasseRepository $classeRepository): Response
    {
        $sortField = $request->query->get('sortField', 'libelle_cl'); // Default sorting field
        $sortOrder = $request->query->get('sortOrder', 'asc'); // Default sorting order

        $classes = $classeRepository->findAllSortedBy($sortField, $sortOrder);

        return $this->render('classe/index.html.twig', [
            'classes' => $classes,
        ]);
    }

    //pdf
   
    #[Route('/pdf', name: 'app_classe_pdf', methods: ['GET'])]
    public function pdf(ClasseRepository $classeRepository, PdfService $pdfService): Response
    {
        $classes = $classeRepository->findAll();

        // Générer le contenu HTML pour le PDF
        $html = $this->renderView('classe/pdf.html.twig', [
            'classes' => $classes,
        ]);

        // Générer le PDF à partir du HTML
        $pdfContent = $pdfService->generatePdf($html);

        // Créer et retourner la réponse PDF
        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="classes.pdf"',
        ]);
    }

    #[Route('/etudiants/{id}', name: 'app_get_etudiants', methods: ['GET'])]
    public function getSaisons(Classe $classe, EspEtudiantRepository $espEtudiantRepository): JsonResponse
    {
        $assignedStudents = $classe->getEtudiants();
    
        $assignedStudentsArray = [];
        foreach ($assignedStudents as $student) {
            $assignedStudentsArray[] = [
                'id' => $student->getId_et(),
                'nom' => $student->getNomEt(),
                'prenom' => $student->getPnomEt(),
            ];
        }
        $unassignedStudents = $espEtudiantRepository->createQueryBuilder('e')
        ->where('e.affecte = :affecte')
        ->andWhere('e.inscription = :inscription')
        ->setParameter('affecte', 0)
        ->setParameter('inscription', 1)
        ->getQuery()
        ->getResult();
    
        $unassignedStudentsArray = [];
        foreach ($unassignedStudents as $student) {
            $unassignedStudentsArray[] = [
                'id' => $student->getId_et(),
                'nom' => $student->getNomEt(),
                'prenom' => $student->getPnomEt(),
            ];
        }
        return new JsonResponse([
            'assigned_students' => $assignedStudentsArray,
            'unassigned_students' => $unassignedStudentsArray,
        ]);
    }

    #[Route('/affecter-etudiants', name: 'app_affecter_etudiants', methods: ['POST'])]
    public function affecterEtudiants(Request $request, ClasseRepository $classeRepo, EspEtudiantRepository $etudiantRepo, EntityManagerInterface $entityManager): Response
    {
        $classeId = $request->request->get('classe_id');
        $etudiantsIds = $request->request->get('etudiants_ids', []);
    
        $classe = $classeRepo->findOneById($classeId);
        if (!$classe) {
            throw $this->createNotFoundException("Classe non trouvée");
        }
    
        foreach ($etudiantsIds as $etudiantId) {
            $etudiant = $etudiantRepo->find($etudiantId);
            if ($etudiant) {
                $etudiant->setClasse($classe);
                $etudiant->setAffecte(true);
                $entityManager->persist($etudiant);
            }
        }
    
        $entityManager->flush();
    
        return $this->redirectToRoute('app_classe_index');
    }
    

    #[Route('/Ouverture-Classe/{id}', name: 'app_Ouverture_classe', methods: ['POST'])]
    public function ouverture(Classe $classe, EntityManagerInterface $entityManager): JsonResponse
    {
        if($classe->isOuvert()){
            return new JsonResponse("Classe deja ouvert");
        }
        else{
            $classe->setOuvert(true);
            $entityManager->persist($classe);
            $entityManager->flush();
            return new JsonResponse("Classe ouvert");
        }
    }
    

}


   




    

    




