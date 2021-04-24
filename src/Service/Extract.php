<?php
namespace App\Service;


 use App\Repository\OfficeRepository;

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
}
?>