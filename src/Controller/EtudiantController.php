<?php

namespace App\Controller;

use App\Entity\CodeNomenclature;
use App\Entity\EspEtudiant;
use App\Entity\PhotosEtudiant;
use App\Form\Etudiantform1Type;
use App\Form\Etudiantform2Type;
use App\Form\Etudiantform3Type;
use App\Form\Etudiantform4Type;
use App\Form\Etudiantform5Type;
use App\Form\Etudiantform6Type;
use App\Repository\CompteurRepository;
use App\Repository\EspEtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Flasher\SweetAlert\Prime\SweetAlertInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;

class EtudiantController extends AbstractController
{
    // #[Route('/etudiant', name: 'app_etudiant')]
    
    #[Route('/etudiant/step/{step}', name: 'app_etudiant_step')]
    public function index(
        Request $request,
        SessionInterface $session,
        EntityManagerInterface $entityManager,
        CompteurRepository $compteurRepository,
        int $step,
        SluggerInterface $slugger
    ): Response {
        $etudiant = $session->get('etudiant', null);

        if (!$etudiant instanceof EspEtudiant) {
            $etudiant = new EspEtudiant();
        }

        $form = $this->getFormForStep($step, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($step === 1) {
                $sexe = $form->get('sexe')->getData();
                $etudiant->setIdEt(EspEtudiant::generateIdEt($sexe));

                // Get Compteur with code_cpt '01'
                $compteur = $compteurRepository->findByCodeCpt('01');

                if ($compteur) {
                    // Increment the taille if the compteur is found
                    $compteurRepository->incrementTaille($compteur);
                }
            }

            if ($step == 5) {
                $photoFile = $form->get('photo_et')->getData();
                if ($photoFile instanceof UploadedFile) {
                    $photoDirectory = $this->getParameter('photos_directory');
                    $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();

                    try {
                        $photoFile->move($photoDirectory, $newFilename);
                        $etudiant->setPhotoEt($newFilename);
                    } catch (FileException $e) {
                        $this->addFlash('error', 'Erreur lors du téléchargement de la photo');
                        return $this->redirectToRoute('app_etudiant_step', ['step' => $step]);
                    }
                } else {
                    $this->addFlash('error', 'Veuillez télécharger une photo');
                    return $this->redirectToRoute('app_etudiant_step', ['step' => $step]);
                }
            }

            $session->set('etudiant', $etudiant);

            if ($step < 6) {
                return $this->redirectToRoute('app_etudiant_step', ['step' => $step + 1]);
            }

            $entityManager->persist($etudiant);
            $entityManager->flush();

            $session->remove('etudiant');

            return $this->redirectToRoute('get_etudiants');
        }

        return $this->render('etudiant/index.html.twig', [
            'form' => $form->createView(),
            'step' => $step,
            'id' => $etudiant->getIdEt(),
        ]);
    }

    private function getFormForStep(int $step, EspEtudiant $etudiant)
    {
        switch ($step) {
            case 1:
                return $this->createForm(Etudiantform1Type::class, $etudiant);
            case 2:
                return $this->createForm(Etudiantform2Type::class, $etudiant);
            case 3:
                return $this->createForm(Etudiantform3Type::class, $etudiant);
            case 4:
                return $this->createForm(Etudiantform4Type::class, $etudiant);
            case 5:
                return $this->createForm(Etudiantform5Type::class, $etudiant);
            case 6:
                return $this->createForm(Etudiantform6Type::class, $etudiant);
            default:
                throw new \InvalidArgumentException('Invalid step');
        }
    }

    #[Route('/etudiant/complete', name: 'app_etudiant_complete')]
    public function complete(): Response
    {
        return $this->render('etudiant/complete.html.twig');
    }
  
    #[Route('/get_etudiant', name: 'get_etudiants')]

    public function getEtudiant(EntityManagerInterface $entityManager, Request $request, PaginatorInterface $paginator): Response
    {
        $searchQuery = $request->query->get('q');

        $queryBuilder = $entityManager->getRepository(EspEtudiant::class)->createQueryBuilder('e');

        if ($searchQuery) {
            $queryBuilder->where('e.id_et LIKE :searchQuery OR e.nom_et LIKE :searchQuery')
                ->setParameter('searchQuery', '%' . $searchQuery . '%');
        }

        // Paginate the results of the query
        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1), // The current page number, default to 1
            5 // Number of results per page
        );

        // Handle photo extraction and storage
        foreach ($pagination as $etudiant) {
            $photoFilename = $etudiant->getPhotoEt();

            if ($photoFilename) {
                $photoDirectory = $this->getParameter('photos_directory');
                $photoPath = $photoDirectory . '/' . $photoFilename;

                if (file_exists($photoPath)) {
                    $photoData = file_get_contents($photoPath);

                    $photosEtudiant = $entityManager->getRepository(PhotosEtudiant::class)->findOneBy(['id_et' => $etudiant]);

                    if (!$photosEtudiant) {
                        $photosEtudiant = new PhotosEtudiant();
                        $photosEtudiant->setIdEt($etudiant);
                    }

                    $photosEtudiant->setPhotosId($photoData);

                    $entityManager->persist($photosEtudiant);
                }
            }
        }

        $entityManager->flush();

        return $this->render('etudiant/etudiant.html.twig', [
            'pagination' => $pagination,
            'searchQuery' => $searchQuery,
        ]);
    }


    #[Route('/etudiant/autocomplete', name: 'etudiant_autocomplete', methods: ['GET'])]
    public function autocomplete(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $searchTerm = $request->query->get('term');

        $results = [];

        if ($searchTerm) {
            $queryBuilder = $entityManager->getRepository(EspEtudiant::class)->createQueryBuilder('e');
            $queryBuilder->select('e.id_et', 'e.nom_et')
                ->where('e.id_et LIKE :searchTerm OR e.nom_et LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $searchTerm . '%')
                ->setMaxResults(10);

            $etudiants = $queryBuilder->getQuery()->getResult();

            foreach ($etudiants as $etudiant) {
                $results[] = [
                    'id' => $etudiant['id_et'],
                    'label' => $etudiant['nom_et'] . ' (' . $etudiant['id_et'] . ')',
                    'value' => $etudiant['nom_et'],
                ];
            }
        }

        return new JsonResponse($results);
    }

  
    #[Route('/etudiant/delete/{id_et}', name: 'app_etudiant_delete', methods: ['POST', 'DELETE'])]
    public function delete(
        string $id_et,
        EntityManagerInterface $entityManager,
        CompteurRepository $compteurRepository
    ): Response {
        $etudiant = $entityManager->getRepository(EspEtudiant::class)->find($id_et);

        if ($etudiant) {
            // Assuming that the student's Compteur code is '01'
            $compteur = $compteurRepository->findByCodeCpt('01');

            if ($compteur) {
                // Decrement the taille if the compteur is found
                $compteurRepository->decrementTaille($compteur);
            }

            $entityManager->remove($etudiant);
            $entityManager->flush();

            $this->addFlash('success', 'Student deleted successfully.');
        } else {
            $this->addFlash('error', 'Student not found.');
        }

        return $this->redirectToRoute('get_etudiants');
    }

    
    #[Route('/etudiant/edit/{id}/{step}', name: 'app_etudiant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ManagerRegistry $doctrine, string $id, int $step, SluggerInterface $slugger): Response
    {
        $entityManager = $doctrine->getManager();
        $etudiant = $entityManager->getRepository(EspEtudiant::class)->find($id);

        if (!$etudiant) {
            throw $this->createNotFoundException('Student not found');
        }

        // Get the form based on the current step
        $form = $this->getFormForStep($step, $etudiant);

        // Handle the request
        $form->handleRequest($request);

        // If the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Handle photo upload only if it is present in the form
            if ($step == 5) {
                $photoField = $form->get('photo_et');
                if ($photoField && $photoField->getData() instanceof UploadedFile) {
                    $photoFile = $photoField->getData();

                    // Define the directory where the photo will be saved
                    $photoDirectory = $this->getParameter('photos_directory');

                    // Ensure the filename is unique
                    $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();

                    // Move the file to the target directory
                    try {
                        $photoFile->move($photoDirectory, $newFilename);

                        // Set the file path in the database (you may store the full path or just the filename)
                        $etudiant->setPhotoEt($newFilename);
                    } catch (FileException $e) {
                        $this->addFlash('error', 'Erreur lors du téléchargement de la photo');
                        return $this->redirectToRoute('app_etudiant_edit', ['id' => $id, 'step' => $step]);
                    }
                }
            }

            // Persist the entity after every step
            $entityManager->persist($etudiant); // Make sure changes are persisted
            $entityManager->flush(); // Flush changes to the database

            $this->addFlash('success', 'Student updated successfully.');

            // Redirect to the next step or back to the list after the last step
            if ($step < 6) {
                return $this->redirectToRoute('app_etudiant_edit', ['id' => $id, 'step' => $step + 1]);
            } else {
                return $this->redirectToRoute('get_etudiants');
            }
        }

        return $this->render('etudiant/update.html.twig', [
            'form' => $form->createView(),
            'step' => $step,
            'id' => $id, // Pass 'id' to the Twig template
            'is_edit' => (bool) $id,
            'currentPhoto' => $etudiant->getPhotoEt(), // Pass the current photo
        ]);
    }
    #[Route('/etudiant/show/{id}', name: 'app_etudiant_show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, string $id): Response
    {
        $entityManager = $doctrine->getManager();
        $etudiant = $entityManager->getRepository(EspEtudiant::class)->find($id);

        if (!$etudiant) {
            throw $this->createNotFoundException('Student not found');
        }

        return $this->render('etudiant/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }
 
    #[Route('/stat_etudiant', name: 'bar_chart')]
    public function stat(EspEtudiantRepository $etudiantRepo): Response
    {
        // Get data for the bar chart (etab_origine)
        $etabOrigineData = $etudiantRepo->getEtabOrigineData();

        $labels = [];
        $values = [];
        foreach ($etabOrigineData as $data) {
            $labels[] = $data['etab_origine'];
            $values[] = $data['count'];
        }

        // Get data for the pie chart (gender)
        $genderCounts = $etudiantRepo->getGenderCounts();
        $maleCount = 0;
        $femaleCount = 0;
        foreach ($genderCounts as $data) {
            if ($data['sexe'] === 'M') {
                $maleCount = $data['count'];
            } elseif ($data['sexe'] === 'F') {
                $femaleCount = $data['count'];
            }
        }

        return $this->render('etudiant/stat_et.html.twig', [
            'labels' => json_encode($labels),
            'values' => json_encode($values),
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
        ]);
    }
}





















   // #[Route('/stat_etudiant', name: 'statistiques')]
    // public function chartData(EntityManagerInterface $entityManager): Response
    // {
    //     $repository = $entityManager->getRepository(EspEtudiant::class);

    //     $maleCount = $repository->createQueryBuilder('e')
    //         ->select('COUNT(e.id_et)')
    //         ->where('e.sexe = :male')
    //         ->setParameter('male', 'M')
    //         ->getQuery()
    //         ->getSingleScalarResult();

    //     $femaleCount = $repository->createQueryBuilder('e')
    //         ->select('COUNT(e.id_et)')
    //         ->where('e.sexe = :female')
    //         ->setParameter('female', 'F')
    //         ->getQuery()
    //         ->getSingleScalarResult();

    //     return $this->render('etudiant/stat_et.html.twig', [
    //         'maleCount' => $maleCount,
    //         'femaleCount' => $femaleCount,
    //     ]);
    // }
      // #[Route('/get_etudiant', name: 'get_etudiants')]
    // public function getEtudiant(EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    // {
    //     // Retrieve all students
    //     $etudiants = $entityManager->getRepository(EspEtudiant::class)->findAll();

    //     foreach ($etudiants as $etudiant) {
    //         $photoFilename = $etudiant->getPhotoEt();

    //         if ($photoFilename) {
    //             $photoDirectory = $this->getParameter('photos_directory');
    //             $photoPath = $photoDirectory . '/' . $photoFilename;

    //             if (file_exists($photoPath)) {
    //                 // Read the photo as binary data
    //                 $photoData = file_get_contents($photoPath);

    //                 // Retrieve existing PhotosEtudiant entity or create a new one
    //                 $photosEtudiant = $entityManager->getRepository(PhotosEtudiant::class)->findOneBy(['id_et' => $etudiant]);

    //                 if (!$photosEtudiant) {
    //                     // Create a new PhotosEtudiant entity if it does not exist
    //                     $photosEtudiant = new PhotosEtudiant();
    //                     $photosEtudiant->setIdEt($etudiant);
    //                 }

    //                 // Update the PhotosEtudiant entity
    //                 $photosEtudiant->setPhotosId($photoData);

    //                 // Persist the PhotosEtudiant entity
    //                 $entityManager->persist($photosEtudiant);
    //             }
    //         }
    //     }

    //     // Flush all changes to the database
    //     $entityManager->flush();

    //     // Render the list of students
    //     return $this->render('etudiant/etudiant.html.twig', [
    //         'etudiants' => $etudiants,
    //     ]);
    // }
      // public function getEtudiant(EntityManagerInterface $entityManager): Response
    // {
    //     // Utilisez l'EntityManager injecté pour récupérer tous les étudiants
    //     $etudiants = $entityManager->getRepository(EspEtudiant::class)->findAll();

    //     // Créer un tableau pour stocker les étudiants avec leurs photos encodées en Base64
    //     $etudiantsData = [];

    //     foreach ($etudiants as $etudiant) {
    //         // Convertir la photo binaire en Base64
    //         $photoBase64 = null;
    //         if ($etudiant->getPhotoEt()) { // Assurez-vous d'utiliser le bon getter
    //             $photoBase64 = base64_encode(stream_get_contents($etudiant->getPhotoEt()));
    //         }

    //         // Ajouter l'étudiant et sa photo encodée au tableau
    //         $etudiantsData[] = [
    //             'idEt' => $etudiant->getIdEt(),
    //             'niveauAcces' => $etudiant->getNiveauAcces(),
    //             'nomEt' => $etudiant->getNomEt(),
    //             'classeCouranteEt' => $etudiant->getClasseCouranteEt(),
    //             'numCinPasseport' => $etudiant->getNumCinPasseport(),
    //             'pnomEt' => $etudiant->getPnomEt(),
    //             'dateNaisEt' => $etudiant->getDateNaisEt(),
    //             'lieuNaisEt' => $etudiant->getLieuNaisEt(),
    //             'sexe' => $etudiant->getSexe(),
    //             'adresseEt' => $etudiant->getAdresseEt(),
    //             'telEt' => $etudiant->getTelEt(),
    //             'emailEt' => $etudiant->getEmailEt(),
    //             'cpEt' => $etudiant->getCpEt(),
    //             'nationalite' => $etudiant->getNationalite(),
    //             'villeEt' => $etudiant->getVilleEt(),
    //             'paysEt' => $etudiant->getPaysEt(),
    //             'telParentEt' => $etudiant->getTelParentEt(),
    //             'emailParent' => $etudiant->getEmailParent(),
    //             'photoBase64' => $photoBase64,
    //             'cpParent' => $etudiant->getCpParent(),
    //             'adresseParent' => $etudiant->getAdresseParent(),
    //             'paysParent' => $etudiant->getPaysParent(),
    //             'natureEt' => $etudiant->getNatureEt(),
    //             'fonctionEt' => $etudiant->getFonctionEt(),
    //             'cycleEt' => $etudiant->getCycleEt(),
    //             'natureBac' => $etudiant->getNatureBac(),
    //             'dateBac' => $etudiant->getDateBac(),
    //             'numBacEt' => $etudiant->getNumBacEt(),
    //             'etabBac' => $etudiant->getEtabBac(),
    //             'diplomeSupEt' => $etudiant->getDiplomeSupEt(),
    //             'niveauDiplomeSupEt' => $etudiant->getNiveauDiplomeSupEt(),
    //             'etabOrigine' => $etudiant->getEtabOrigine(),
    //             'specialiteEspEt' => $etudiant->getSpeialiteEspEt(),
    //             'dateEntreeEspEt' => $etudiant->getDateEntreeEspEt(),
    //             'anneeEntreeEspEt' => $etudiant->getAnneeEntreeEspEt(),
    //             'situationFinanciereEt' => $etudiant->getSituationFinanciereEt(),
    //             'niveauCourantEt' => $etudiant->getNiveauCourantEt(),
    //             'moyenneDernSemestreEt' => $etudiant->getMoyenneDernSemestreEt(),
    //             'resultatFinalEt' => $etudiant->getResultatFinalEt(),
    //             'dateSortieEt' => $etudiant->getDateSortieEt(),
    //             'dateSaisie' => $etudiant->getDateSaisie(),
    //             'dateDernModif' => $etudiant->getDateDernModif(),
    //             'agent' => $etudiant->getAgent(),
    //             'numOrd' => $etudiant->getNumOrd(),
    //             'dateDelivrance' => $etudiant->getDateDelivrance(),
    //             'lieuDelivrance' => $etudiant->getLieuDelivrance(),
    //             'natureCours' => $etudiant->getNatureCours(),
    //             'naturePieceId' => $etudiant->getNaturePieceId(),
    //             'observationEt' => $etudiant->getObservationEt(),
    //         ];
    //     }

    //     // Rendre la vue et passer les données des étudiants au template
    //     return $this->render('etudiant/etudiant.html.twig', [
    //         'etudiants' => $etudiantsData,
    //     ]);
    // }
// public function index(Request $request, SessionInterface $session): Response
    // {
    //     return $this->redirectToRoute('app_etudiant_step', ['step' => 1]);
    // }

    // #[Route('/etudiant/step/{step}', name: 'app_etudiant_step')]
    // public function index(Request $request, SessionInterface $session, int $step): Response
    // {
    //     $etudiant = $session->get('etudiant', new EspEtudiant());
    //     $etudiant = new EspEtudiant();
    //     $etudiant->setIdEt(EspEtudiant::generateIdEt()); // Set the generated ID

    //     $form = null;
    //     switch ($step) {
    //         case 1:
    //             $form = $this->createForm(Etudiantform1Type::class, $etudiant);
    //             break;
    //         case 2:
    //             $form = $this->createForm(Etudiantform2Type::class, $etudiant);
    //             break;
    //         case 3:
    //             $form = $this->createForm(Etudiantform3Type::class, $etudiant);
    //             break;
    //         case 4:
    //             $form = $this->createForm(Etudiantform4Type::class, $etudiant);
    //             break;
    //         case 5:
    //             $form = $this->createForm(Etudiantform5Type::class, $etudiant);
    //             break;
    //         case 6:
    //             $form = $this->createForm(Etudiantform6Type::class, $etudiant);
    //             break;
    //         default:
    //             return $this->redirectToRoute('app_etudiant_step', ['step' => 1]);
    //     }

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         if ($step == 5) {
    //             $photoFile = $form['photo_et']->getData();
    //             if ($photoFile) {
    //                 try {
    //                     $photoData = file_get_contents($photoFile->getPathname());
    //                     $etudiant->setPhotoEt($photoData);
    //                 } catch (FileException $e) {
    //                     // Gérer l'exception en cas de problème lors du téléchargement de l'image
    //                     $this->addFlash('error', 'Erreur lors du téléchargement de la photo');
    //                     return $this->redirectToRoute('app_etudiant_step', ['step' => $step]);
    //                 }
    //             } else {
    //                 $this->addFlash('error', 'Veuillez télécharger une photo');
    //                 return $this->redirectToRoute('app_etudiant_step', ['step' => $step]);
    //             }
    //         }

    //         $session->set('etudiant', $etudiant);

    //         if ($step < 6) {
    //             return $this->redirectToRoute('app_etudiant_step', ['step' => $step + 1]);
    //         }

    //         // Dernière étape - enregistrez l'étudiant dans la base de données ou effectuez d'autres actions
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($etudiant);
    //         $entityManager->flush();

    //         $session->remove('etudiant');

    //         return $this->redirectToRoute('app_etudiant_complete');
    //     }

    //     return $this->render('etudiant/index.html.twig', [
    //         'form' => $form->createView(),
    //         'step' => $step,
    //     ]);
    // }

    // #[Route('/etudiant/step/{step}', name: 'app_etudiant_step')]
    // public function index(
    //     Request $request,
    //     SessionInterface $session,
    //     EntityManagerInterface $entityManager,
    //     int $step,
    //     SluggerInterface $slugger
    // ): Response {
    //     // Retrieve existing student from session or create a new one
    //     $etudiant = $session->get('etudiant', null);

    //     // Create a new student object if it's not in session
    //     if (!$etudiant instanceof EspEtudiant) {
    //         $etudiant = new EspEtudiant();
    //     }

    //     // Determine which form to create based on the step
    //     $form = $this->getFormForStep($step, $etudiant);

    //     // Handle form submission
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         if ($step == 5) {
    //             $photoFile = $form->get('photo_et')->getData();
    //             if ($photoFile instanceof UploadedFile) {
    //                 // Define the directory where the photo will be saved
    //                 $photoDirectory = $this->getParameter('photos_directory');

    //                 // Ensure the filename is unique
    //                 $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
    //                 $safeFilename = $slugger->slug($originalFilename);
    //                 $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();

    //                 // Move the file to the target directory
    //                 try {
    //                     $photoFile->move($photoDirectory, $newFilename);

    //                     // Set the file path in the database (you may store the full path or just the filename)
    //                     $etudiant->setPhotoEt($newFilename);
    //                 } catch (FileException $e) {
    //                     // Handle exception during photo upload
    //                     $this->addFlash('error', 'Erreur lors du téléchargement de la photo');
    //                     return $this->redirectToRoute('app_etudiant_step', ['step' => $step]);
    //                 }
    //             } else {
    //                 $this->addFlash('error', 'Veuillez télécharger une photo');
    //                 return $this->redirectToRoute('app_etudiant_step', ['step' => $step]);
    //             }
    //         }

    //         // Save the updated student data to the session
    //         $session->set('etudiant', $etudiant);

    //         // Check if it's the last step
    //         if ($step < 6) {
    //             return $this->redirectToRoute('app_etudiant_step', ['step' => $step + 1]);
    //         }

    //         // Final step - generate ID and save the student to the database
    //         $gender = $etudiant->getGender(); // Assume gender is set in a previous step
    //         $etudiant->setIdEt(self::generateIdEt($gender));
    //         $entityManager->persist($etudiant);
    //         $entityManager->flush();

    //         // Clear the session
    //         $session->remove('etudiant');

    //         // Redirect to completion page
    //         return $this->redirectToRoute('get_etudiants');
    //     }

    //     // Render the form for the current step
    //     return $this->render('etudiant/index.html.twig', [
    //         'form' => $form->createView(),
    //         'step' => $step,
    //         'id' => $etudiant->getIdEt(),
    //     ]);
    // }
    // #[Route('/etudiant/step/{step}', name: 'app_etudiant_step')]
    // public function index(
    //     Request $request,
    //     SessionInterface $session,
    //     EntityManagerInterface $entityManager,
    //     int $step,
    //     SluggerInterface $slugger
    // ): Response {
    //     // Retrieve existing student from session or create a new one
    //     $etudiant = $session->get('etudiant', null);

    //     // Create a new student object if it's not in session
    //     if (!$etudiant instanceof EspEtudiant) {
    //         $etudiant = new EspEtudiant();
    //     }

    //     // Determine which form to create based on the step
    //     $form = $this->getFormForStep($step, $etudiant);

    //     // Handle form submission
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // Retrieve the gender from the form data


    //         if ($step === 1) {
    //             $sexe = $form->get('sexe')->getData(); // Use 'sexe' instead of 'gender'
    //             $etudiant->setIdEt(EspEtudiant::generateIdEt($sexe)); // Set the generated ID
    //         }

    //         if ($step == 5) {
    //             $photoFile = $form->get('photo_et')->getData();
    //             if ($photoFile instanceof UploadedFile) {
    //                 // Define the directory where the photo will be saved
    //                 $photoDirectory = $this->getParameter('photos_directory');

    //                 // Ensure the filename is unique
    //                 $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
    //                 $safeFilename = $slugger->slug($originalFilename);
    //                 $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();

    //                 // Move the file to the target directory
    //                 try {
    //                     $photoFile->move($photoDirectory, $newFilename);

    //                     // Set the file path in the database (you may store the full path or just the filename)
    //                     $etudiant->setPhotoEt($newFilename);
    //                 } catch (FileException $e) {
    //                     // Handle exception during photo upload
    //                     $this->addFlash('error', 'Erreur lors du téléchargement de la photo');
    //                     return $this->redirectToRoute('app_etudiant_step', ['step' => $step]);
    //                 }
    //             } else {
    //                 $this->addFlash('error', 'Veuillez télécharger une photo');
    //                 return $this->redirectToRoute('app_etudiant_step', ['step' => $step]);
    //             }
    //         }

    //         // Save the updated student data to the session
    //         $session->set('etudiant', $etudiant);

    //         // Check if it's the last step
    //         if ($step < 6) {
    //             return $this->redirectToRoute('app_etudiant_step', ['step' => $step + 1]);
    //         }

    //         // Final step - save the student to the database
    //         $entityManager->persist($etudiant);
    //         $entityManager->flush();

    //         // Clear the session
    //         $session->remove('etudiant');

    //         // Redirect to completion page
    //         return $this->redirectToRoute('get_etudiants');
    //     }

    //     // Render the form for the current step
    //     return $this->render('etudiant/index.html.twig', [
    //         'form' => $form->createView(),
    //         'step' => $step,
    //         'id' => $etudiant->getIdEt(),
    //     ]);
    // }