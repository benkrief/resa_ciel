<?php

namespace App\Controller;

use App\Entity\Sub;
use App\Repository\OfficeRepository;
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
    private ContactController $contactController;
    public function __construct(EntityManagerInterface $em, SessionInterface $session, OfficeRepository $officeRepo, ContactController $contactController){
        $this->em=$em;
        $this->session=$session;
        $this->session->start();
        $this->officeRepo=$officeRepo;
        $this->contactController=$contactController;

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

            foreach ($this->officeRepo->office() as $off){
                $office[$off["id"]]=$off["title"];
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
                $sub->setNom($_POST["nom_".$key."_".$j]);
                $sub->setPrenom($_POST["prenom_".$key."_".$j]);
                $sub->setEmail($_POST["email_".$key."_".$j]);
                $this->contactController->sendEmail($_POST["email_".$key."_".$j],[
                    "sub"=>$sub,
                    "office"=>$office,
                ]);
                $this->em->persist($sub);
                $this->em->flush();

            }
        }
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
