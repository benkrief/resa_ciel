<?php

namespace App\Controller;

use App\Entity\Office;
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
            $left=$this->subRepo->list($off->getId());
        }
        if(!isset($left))
            $left=0;

        return $this->render('office/index.html.twig', [
            'offices'=>$office,
            'leftplace'=>$left,
            'admin'=>false,

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
            $left=$this->subRepo->list($off->getId());
        }
        if(!isset($left))
            $left=0;
        return $this->render('office/index.html.twig', [
            'offices'=>$office,
            'leftplace'=>$left,
            'admin'=>$admin,

        ]);
    }



    /**
     * @Route("/{id}/{admin}", name="office_show", methods={"GET"})
     */
    public function show(Office $office, $admin): Response
    {
        return $this->render('office/show.html.twig', [
            'office' => $office,
            'admin'=>$admin,
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
        return $this->render('office/list.html.twig', [
            'offices' => $office,
            'admin'=>$_GET["admin"],
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
            $this->excel->extract($list);
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

}
