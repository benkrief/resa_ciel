<?php
namespace App\Service;


use App\Repository\OfficeRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class Extract
{
    private OfficeRepository   $officeRepository;
    public function __construct(OfficeRepository $officeRepository)
    {
        $this->officeRepository=$officeRepository;
    }

    public function extract(array $list)
    {

        header("Content-Type: text/csv;");
        header("Content-Disposition: attachment; filename=office.csv");

        foreach ($list as $key=>$office) {
            $idoffice=$this->officeRepository->find(intval($key));

            echo "\n".'"Office";"Lieu";"Personne n°";"Nom";"Prénom"';
            $i=1;
            foreach ($office as $personne) {

                echo "\n" . '"'.$idoffice->getTitle().'";"'.$idoffice->getLieu().'";"'.$i++.'";"'. $personne["nom"] . '";"' . $personne["prenom"] . '"';
            }
            echo "\n";
            if ($i>9)
                echo "Minyan !";
            else
                echo "Pas Minyan";
            echo "\n";
        }
        echo "\n";

    }

    public function test(array $list)
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Office.xls"');
        header('Cache-Control: max-age=0');
        $spreadsheet = new Spreadsheet();



        $alphabetv=['','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $alphabet=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $a=1;
        foreach ($alphabetv as $le){
            foreach ($alphabet as $lep){
                $alpha[$a]=$le.$lep;
                $a++;
            }
        }
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                ],
                'bottom' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                ],
                'right' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                ],
                'left' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFFFF',
                ],
                'endColor' => [
                    'argb' => '000000',
                ],
            ],
        ];
        $worksheet = $spreadsheet->getActiveSheet();
        $i=0;
        foreach ($list as $key => $office) {
            $i=$i+1;
            $l=1;
            $pers = 1;
            $idoffice = $this->officeRepository->find(intval($key));
            $worksheet->getCell($alpha[$i] . '1')->setValue('Office');
            $worksheet->getCell($alpha[$i+1] . '1')->setValue('Lieu');
            $worksheet->getCell($alpha[$i+2] . '1')->setValue('Personne n°');
            $worksheet->getCell($alpha[$i+3] . '1')->setValue('Nom');
            $worksheet->getCell($alpha[$i+4] . '1')->setValue('Prénom');

            foreach ($office as $personne) {
                $l++;
                $worksheet->getCell($alpha[$i] . $l)->setValue($idoffice->getTitle());
                $worksheet->getCell($alpha[$i+1] . $l)->setValue($idoffice->getLieu());
                $worksheet->getCell($alpha[$i+2] . $l)->setValue($pers++);
                $worksheet->getCell($alpha[$i+3] . $l)->setValue($personne["nom"]);
                $worksheet->getCell($alpha[$i+4] . $l)->setValue($personne["prenom"]);
            }
            $spreadsheet->getActiveSheet()->getStyle($alpha[$i].($l+1).':'.$alpha[$i+4].($l+1))->applyFromArray($this->minian($pers));
            $cel=$worksheet->mergeCells($alpha[$i].($l+1).':'.$alpha[$i+4].($l+1));
            $cel->setCellValue($alpha[$i].($l+1),$this->minianb($pers));
            if ($l<10){$l=10;}
            $spreadsheet->getActiveSheet()->getStyle($alpha[$i+5].'1:'.$alpha[$i+5].$l)->applyFromArray(['fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '808080',
                ],

            ],]);

            $spreadsheet->getActiveSheet()->getStyle($alpha[$i].'1:'.$alpha[$i+4].'1')->applyFromArray($styleArray);

            $i=$i+5;
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    public function minian(int $i):array{
        if($i<9)
        {
            return
                [
                    'font' => [
                        'bold' => true,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                        ],
                        'bottom' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                        ],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => '#ff0000',
                        ],
                        'endColor' => [
                            'argb' => '000000',
                        ],
                    ],
                ];
        }
        else
            return [];
    }
    public function minianb(int $i):string{
        if ($i<9)
            return "Il n'y a pas Mynian";
        else
            return '';
    }

}
?>