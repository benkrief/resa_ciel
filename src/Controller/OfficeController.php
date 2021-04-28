<?php

namespace App\Controller;

use App\Entity\Office;
use App\Entity\Sub;
use App\Form\OfficeType;
use App\Repository\OfficeRepository;
use App\Repository\SubRepository;
use App\Service\Extract;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/office")
 */
class OfficeController extends AbstractController
{
    private OfficeRepository $officeRepo;
    private SubRepository $subRepo;
    private EntityManagerInterface $em;
    private Extract $excel;

    public function __construct(OfficeRepository $officeRepo,SubRepository $subRepo, EntityManagerInterface $em, Extract $excel)
    {
        $this->officeRepo=$officeRepo;
        $this->subRepo=$subRepo;
        $this->em=$em;
        $this->excel=$excel;
    }

    /**
     * @Route("/", name="office_index", methods={"GET"})
     */
    public function index(): Response
    {
        $office=$this->officeRepo->findAll();
        foreach ($office as $off){
            if(!isset($left))
                $left[$off->getId()]=0;
            else
                $left[$off->getId()]=$this->subRepo->list($off->getId());
        }
        foreach ($office as $off){
            if(!isset($left))
                $leftmax[$off->getId()]=0;
            else
                $leftmax[$off->getId()]=$off->getMaxSub()-($this->subRepo->list($off->getId()));
        }

        $dateo=[];
        foreach ($this->officeRepo->date_office() as $doff){
            $dateo[$doff["id"]]=array('jour'=>date_format($doff["date"],'N'),'nbjour'=>date_format($doff["date"],'j'),'mois'=>date_format($doff["date"],'n'),'annee'=>date_format($doff["date"],'Y'));
        }

        $date=[];
        foreach ($dateo as $key=>$d){
            if ($d["jour"]==1){$j="Lundi";}elseif($d["jour"]==2){$j="Mardi";}elseif($d["jour"]==3){$j="Mercredi";}elseif($d["jour"]==4){$j="Jeudi";}elseif($d["jour"]==5){$j="Vendredi";}elseif($d["jour"]==6){$j="Samedi";}else{$j="Dimanche";}
            if($d["mois"]==1){$m="Janvier";}elseif($d["mois"]==2){$m="Fevrier";}elseif($d["mois"]==3){$m="Mars";}elseif($d["mois"]==4){$m="Avril";}elseif($d["mois"]==5){$m="Mai";}elseif($d["mois"]==6){$m="Juin";}elseif($d["mois"]==7){$m="Juillet";}elseif($d["mois"]==8){$m="Aout";}elseif($d["mois"]==9){$m="Septembre";}elseif($d["mois"]==10){$m="Octobre";}elseif($d["mois"]==11){$m="Novembre";}else{$m="Décembre";}
            $date[$key]=$j.' '.$d["nbjour"].' '.$m.' '.$d["annee"];
        }


        return $this->render('office/index.html.twig', [
            'offices'=>$office,
            'leftplace'=>$left,
            'admin'=>false,
            "dateo"=>$date,
            "max"=>$leftmax,

        ]);
    }
    /**
     * @Route("/new", name="office_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $office = new Office();
        $form = $this->createForm(OfficeType::class, $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($office);
            $this->em->flush();

            return $this->redirectToRoute('office_admin',[
                'admin'=>$_GET["admin"]
            ]);
        }

        return $this->render('office/new.html.twig', [
            'office' => $office,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{admin}", name="office_admin")
     * @return Response
     */
    public function admin(string $admin):Response
    {
        $office=$this->officeRepo->findAll();
        foreach ($office as $off){
            if(!isset($left))
                $left[$off->getId()]=0;
            else
                $left[$off->getId()]=$this->subRepo->list($off->getId());
        }
        foreach ($office as $off){
            if(!isset($left))
                $leftmax[$off->getId()]=0;
            else
                $leftmax[$off->getId()]=$off->getMaxSub()-($this->subRepo->list($off->getId()));
        }
        $dateo=[];
        foreach ($this->officeRepo->date_office() as $doff){
            $dateo[$doff["id"]]=array('jour'=>date_format($doff["date"],'N'),'nbjour'=>date_format($doff["date"],'j'),'mois'=>date_format($doff["date"],'n'),'annee'=>date_format($doff["date"],'Y'));
        }

        $date=[];
        foreach ($dateo as $key=>$d){
            if ($d["jour"]==1){$j="Lundi";}elseif($d["jour"]==2){$j="Mardi";}elseif($d["jour"]==3){$j="Mercredi";}elseif($d["jour"]==4){$j="Jeudi";}elseif($d["jour"]==5){$j="Vendredi";}elseif($d["jour"]==6){$j="Samedi";}else{$j="Dimanche";}
            if($d["mois"]==1){$m="Janvier";}elseif($d["mois"]==2){$m="Fevrier";}elseif($d["mois"]==3){$m="Mars";}elseif($d["mois"]==4){$m="Avril";}elseif($d["mois"]==5){$m="Mai";}elseif($d["mois"]==6){$m="Juin";}elseif($d["mois"]==7){$m="Juillet";}elseif($d["mois"]==8){$m="Aout";}elseif($d["mois"]==9){$m="Septembre";}elseif($d["mois"]==10){$m="Octobre";}elseif($d["mois"]==11){$m="Novembre";}else{$m="Décembre";}
            $date[$key]=$j.' '.$d["nbjour"].' '.$m.' '.$d["annee"];
        }
        return $this->render('office/index.html.twig', [
            'offices'=>$office,
            'leftplace'=>$left,
            'admin'=>$admin,
            'dateo'=>$date,
            'max'=>$leftmax,

        ]);
    }



    /**
     * @Route("/{id}/{admin}", name="office_show", methods={"GET"})
     */
    public function show(Office $office, $admin): Response
    {
        $dateo=[];
        foreach ($this->officeRepo->date_office_id($office->getId()) as $doff){
            $dateo[$doff["id"]]=array('jour'=>date_format($doff["date"],'N'),'nbjour'=>date_format($doff["date"],'j'),'mois'=>date_format($doff["date"],'n'),'annee'=>date_format($doff["date"],'Y'));
        }

        $date=[];
        foreach ($dateo as $d){
            if ($d["jour"]==1){$j="Lundi";}elseif($d["jour"]==2){$j="Mardi";}elseif($d["jour"]==3){$j="Mercredi";}elseif($d["jour"]==4){$j="Jeudi";}elseif($d["jour"]==5){$j="Vendredi";}elseif($d["jour"]==6){$j="Samedi";}else{$j="Dimanche";}
            if($d["mois"]==1){$m="Janvier";}elseif($d["mois"]==2){$m="Fevrier";}elseif($d["mois"]==3){$m="Mars";}elseif($d["mois"]==4){$m="Avril";}elseif($d["mois"]==5){$m="Mai";}elseif($d["mois"]==6){$m="Juin";}elseif($d["mois"]==7){$m="Juillet";}elseif($d["mois"]==8){$m="Aout";}elseif($d["mois"]==9){$m="Septembre";}elseif($d["mois"]==10){$m="Octobre";}elseif($d["mois"]==11){$m="Novembre";}else{$m="Décembre";}
            $date=$j.' '.$d["nbjour"].' '.$m.' '.$d["annee"];
        }
        return $this->render('office/show.html.twig', [
            'office' => $office,
            'admin'=>$admin,
            'date'=>$date
        ]);
    }

    /**
     * @Route("/{id}/edit/{admin}", name="office_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Office $office, $admin): Response
    {
        $form = $this->createForm(OfficeType::class, $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('office_admin',[
                'admin'=>$admin,
            ]);
        }

        return $this->render('office/edit.html.twig', [
            'office' => $office,
            'admin'=>$admin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/list", name="office_list",methods={"GET","POST"})
     */
    public function list(): Response
    {
        $office=$this->officeRepo->findAll();
        $dateo=[];
        foreach ($this->officeRepo->date_office() as $doff){
            $dateo[$doff["id"]]=array('jour'=>date_format($doff["date"],'N'),'nbjour'=>date_format($doff["date"],'j'),'mois'=>date_format($doff["date"],'n'),'annee'=>date_format($doff["date"],'Y'));
        }

        $date=[];
        foreach ($dateo as $key=>$d){
            if ($d["jour"]==1){$j="Lundi";}elseif($d["jour"]==2){$j="Mardi";}elseif($d["jour"]==3){$j="Mercredi";}elseif($d["jour"]==4){$j="Jeudi";}elseif($d["jour"]==5){$j="Vendredi";}elseif($d["jour"]==6){$j="Samedi";}else{$j="Dimanche";}
            if($d["mois"]==1){$m="Janvier";}elseif($d["mois"]==2){$m="Fevrier";}elseif($d["mois"]==3){$m="Mars";}elseif($d["mois"]==4){$m="Avril";}elseif($d["mois"]==5){$m="Mai";}elseif($d["mois"]==6){$m="Juin";}elseif($d["mois"]==7){$m="Juillet";}elseif($d["mois"]==8){$m="Aout";}elseif($d["mois"]==9){$m="Septembre";}elseif($d["mois"]==10){$m="Octobre";}elseif($d["mois"]==11){$m="Novembre";}else{$m="Décembre";}
            $date[$key]=$j.' '.$d["nbjour"].' '.$m.' '.$d["annee"];
        }
        return $this->render('office/list.html.twig', [
            'offices' => $office,
            'admin'=>$_GET["admin"],
            'date'=>$date,
        ]);
    }
    /**
     * @Route("/list/export", name="office_export",methods={"GET","POST"})
     */
    public function export():Response
    {
        $list=[];
        if(!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $list[$key] = $this->subRepo->select($key);
            }
            //$this->excel->extract($list);
            $this->excel->test($list);
        }
        return $this->render('sub/noth.html');
    }

    /**
     * @Route("/delete/{id}/{admin}", name="office_delete")
     */
    public function delete(Office $office, $admin): Response
    {
        $this->em->remove($office);
        $this->em->flush();
        return $this->redirectToRoute('office_admin',[
            'admin'=>$admin
        ]);
    }

    /**
     * @Route("/listsub", name="office_sub",methods={"GET","POST"})
     */
    public function sublist():Response
    {
       $offices= $this->officeRepo->findAll();
        foreach ($offices as $office){
            $listsubs[$office->getId()]=$this->subRepo->select($office->getId());
            if(isset($listsubs))
                $listp[$office->getId()]=array("title"=>$office->getTitle(),"lieu"=>$office->getLieu());
        }

        $dateo=[];
        foreach ($this->officeRepo->date_office() as $doff){
            $dateo[$doff["id"]]=array('jour'=>date_format($doff["date"],'N'),'nbjour'=>date_format($doff["date"],'j'));
        }
        $date=[];
        foreach ($dateo as $key=>$d){
            if ($d["jour"]==1){$j="Lundi";}elseif($d["jour"]==2){$j="Mardi";}elseif($d["jour"]==3){$j="Mercredi";}elseif($d["jour"]==4){$j="Jeudi";}elseif($d["jour"]==5){$j="Vendredi";}elseif($d["jour"]==6){$j="Samedi";}else{$j="Dimanche";}
            $date[$key]=$j.' '.$d["nbjour"];
        }
        return $this->render('office/sublist.html.twig', [
            'offices' => $listp,
            'admin'=>$_GET["admin"],
            'date'=>$date,
            'subs'=>$listsubs,
        ]);
    }

    /**
     * @Route("/delete/{idOffice}/{idSub}/{admin}", name="office_subremove")
     */
    public function subremove(Sub $sub, $admin): Response
    {
        $this->em->remove($sub);
        $this->em->flush();
        return $this->redirectToRoute('office_sub',[
            'admin'=>$admin
        ]);
    }

}
