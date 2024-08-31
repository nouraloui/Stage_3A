<?php

namespace App\Controller;

use App\Entity\EspPlanEtude;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
    /**
     * @Route("/export/excel", name="export_excel")
     */
    public function exportExcel(EntityManagerInterface $entityManager): Response
    {
        // Fetch all EspPlanEtude entities
        $repository = $entityManager->getRepository(EspPlanEtude::class);
        $data = $repository->findAll();
    
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set header titles
        $sheet->setCellValue('A1', 'Code Module')
              ->setCellValue('B1', 'Num Panier')
              ->setCellValue('C1', 'Code CL')
              ->setCellValue('D1', 'Année Début')
              ->setCellValue('E1', 'Année Fin')
              ->setCellValue('F1', 'Description')
              ->setCellValue('G1', 'Nb Heures')
              ->setCellValue('H1', 'Coef')
              ->setCellValue('I1', 'Num Semestre')
              ->setCellValue('J1', 'Num Période')
              ->setCellValue('K1', 'Date Début')
              ->setCellValue('L1', 'Date Fin')
              ->setCellValue('M1', 'Date Examen')
              ->setCellValue('N1', 'Date Rattrapage')
              ->setCellValue('O1', 'Nb Horaire Réalisés')
              ->setCellValue('P1', 'À Comptabiliser')
              ->setCellValue('Q1', 'ESP Année Début')
              ->setCellValue('R1', 'Code Salle')
              ->setCellValue('S1', 'Nb Heures Enseignant')
              ->setCellValue('T1', 'Nb Heures Enseignant 2');
    
        // Add data rows
        $rowIndex = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $rowIndex, $item->getCodeModule() ? $item->getCodeModule()->getCodeModule() : '')
                  ->setCellValue('B' . $rowIndex, $item->getNumPanier())
                  ->setCellValue('C' . $rowIndex, $item->getCodeCl())
                  ->setCellValue('D' . $rowIndex, $item->getAnneeDeb())
                  ->setCellValue('E' . $rowIndex, $item->getAnneeFin())
                  ->setCellValue('F' . $rowIndex, $item->getDescription())
                  ->setCellValue('G' . $rowIndex, $item->getNbHeures())
                  ->setCellValue('H' . $rowIndex, $item->getCoef())
                  ->setCellValue('I' . $rowIndex, $item->getNumSemestre())
                  ->setCellValue('J' . $rowIndex, $item->getNumPeriodfe())
                  ->setCellValue('K' . $rowIndex, $item->getDateDebut() ? $item->getDateDebut()->format('Y-m-d') : '')
                  ->setCellValue('L' . $rowIndex, $item->getDateFin() ? $item->getDateFin()->format('Y-m-d') : '')
                  ->setCellValue('M' . $rowIndex, $item->getDateExamen() ? $item->getDateExamen()->format('Y-m-d') : '')
                  ->setCellValue('N' . $rowIndex, $item->getDateRattrapage() ? $item->getDateRattrapage()->format('Y-m-d') : '')
                  ->setCellValue('O' . $rowIndex, $item->getNbHoraireRealises())
                  ->setCellValue('P' . $rowIndex, $item->getAcomptabiliser())
                  ->setCellValue('Q' . $rowIndex, $item->getEspAnneeDeb())
                  ->setCellValue('R' . $rowIndex, $item->getCodeSalle() ? $item->getCodeSalle()->getCodeSalle() : '')
                  ->setCellValue('S' . $rowIndex, $item->getNbHeuresEns())
                  ->setCellValue('T' . $rowIndex, $item->getNbHeuresEns2());
    
            $rowIndex++;
        }
    
        // Write the spreadsheet to a temporary file
        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');
        $writer->save($tempFile);
    
        // Create a response with the Excel file content
        $response = new Response(file_get_contents($tempFile));
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="EspPlanEtude.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');
    
        // Clean up the temporary file
        unlink($tempFile);
    
        return $response;
    }
    
}
