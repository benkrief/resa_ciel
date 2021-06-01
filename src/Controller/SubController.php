<?php

namespace App\Controller;

use App\Entity\Sub;
use App\Repository\OfficeRepository;
use App\Repository\SubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SubController extends AbstractController
{
    private EntityManagerInterface $em;
    private array $subs = [];
    private SessionInterface $session;
    private OfficeRepository $officeRepo;
    private SubRepository $subRepo;
    private ContactController $contactController;
    public function __construct(EntityManagerInterface $em, SessionInterface $session, OfficeRepository $officeRepo, ContactController $contactController,SubRepository $subRepo){
        $this->em=$em;
        $this->session=$session;
        $this->session->start();
        $this->officeRepo=$officeRepo;
        $this->contactController=$contactController;
        $this->subRepo=$subRepo;

    }
    /**
     * @Route("/sub", name="sub")
     */
    public function index(): Response
    {

        if(empty($this->subs)) {
            foreach ($_POST as $key =>$value){
                if($value>0)
                    $this->subs[$key]=intval($value);
            }
            $this->session->set("subs",$this->subs);
            $office=[];

            foreach ($this->officeRepo->findAll() as $off){
                $d["jour"]=date_format($off->getDate(),'N');
                if ($d["jour"]==1){$j="Lundi";}elseif($d["jour"]==2){$j="Mardi";}elseif($d["jour"]==3){$j="Mercredi";}elseif($d["jour"]==4){$j="Jeudi";}elseif($d["jour"]==5){$j="Vendredi";}elseif($d["jour"]==6){$j="Samedi";}else{$j="Dimanche";}
                $office[$off->getId()]=array("title"=>$off->getTitle(),"lieu"=>$off->getLieu(),"date"=>$j,"hour"=>$off->getHour());
            }

        }

        return $this->render('sub/index.html.twig', [
            'subs'=>$this->subs,
            'office'=>$office,

        ]);

    }

    /**
     * @Route("/sub/confirm", name="sub_confirm")
     * @return Response
     */
    public function confirm():Response
    {

        $choice =$this->session->get("subs");
        foreach ($choice as $key=>$value) {
            for ($j=1;$j<$value+1;$j++){
                $office=$this->officeRepo->find($key);

                $sub =new Sub();

                $sub->setIdOffice($office);
                $sub->setNom($_POST["nom"]);
                $sub->setPrenom($_POST["prenom"]);
                $sub->setEmail($_POST["email"]);
                $this->em->persist($sub);
                $this->em->flush();

            }
        }


        $office=[];
        foreach ($this->officeRepo->findAll() as $off){
            $d["jour"]=date_format($off->getDate(),'N');
            if ($d["jour"]==1){$j="Lundi";}elseif($d["jour"]==2){$j="Mardi";}elseif($d["jour"]==3){$j="Mercredi";}elseif($d["jour"]==4){$j="Jeudi";}elseif($d["jour"]==5){$j="Vendredi";}elseif($d["jour"]==6){$j="Samedi";}else{$j="Dimanche";}
            $office[$off->getId()]=array("title"=>$off->getTitle(),"date"=>$j,"hour"=>$off->getHour());
        }
        $list=[];
        $i=0;
        foreach (  $this->subRepo->findbyName($_POST["nom"],$_POST["prenom"],$_POST["email"]) as $of){
            foreach ($of as $o){
                $list[$i++]=$o;
            }
        }

        $this->contactController->sendEmail($_POST["email"],[
            "prenom"=>$_POST["prenom"],
            "nom"=>$_POST["nom"],
            "sub"=>$list,
            "office"=>$office,
        ]);

        return $this->redirectToRoute('valid_sub',['valid'=>true]);

    }
    /**
    public function table(Request $request):Response
    {

    $sub = new Sub();
    $form = $this->createForm(SubFormType::class,$sub);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
    $this->em->persist($sub);
    $this->em->flush();

    return $this->redirectToRoute('valid_sub',['valid'=>true]);
    }

    return $this->render('sub/index.html.twig', [
    'subs'=>[1=>2,2=>1],
    'form' => $form->createView(),

    ]);
    }*/

    /**
     * @Route("/valid",name="valid_sub")
     * @return Response
     */
    public function valid():Response
    {
        $valid=$_GET["valid"];
        if ($valid == null)
            $valid = false;
        $this->session->clear();
        return $this->render('sub/valid.html.twig',[
            "valid"=>$valid,
        ]);
    }


}
