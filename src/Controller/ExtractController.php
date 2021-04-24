<?php

namespace App\Controller;

use App\Entity\Office;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExtractController extends AbstractController
{

    public function downloadAction(array $list)
    {

        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("Resaciel")
            ->setTitle("Office")
            ->setSubject("Liste des offices");

        $sheet = $phpExcelObject->setActiveSheetIndex(0);

        $sheet->setCellValue('A1', 'Office');
        $sheet->setCellValue('B1', 'Heure');
        $sheet->setCellValue('C1', 'Nom');
        $sheet->setCellValue('D1', 'Prenom');


        $counter = 2;
        foreach ($list as $office) {
            foreach ($office as $type){
                $sheet->setCellValue('A' . $counter, $list);
                $sheet->setCellValue('B' . $counter, $list."heure");
                $sheet->setCellValue('C' . $counter, $type["nom"]);
                $sheet->setCellValue('D' . $counter, $type["prenom"]);

                $counter++;
            }
        }

        $phpExcelObject->getActiveSheet()->setTitle($list."office");

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'office'.'.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }


}