<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Professor;
use App\Form\ProfType;
use App\Repository\ProfessorRepository;
 
class ProffessorController extends AbstractController
{
    #[Route('/proffessor', name: 'app_proffessor')]
    public function index(): Response
    {
        return $this->render('proffessor/index.html.twig', [
            'controller_name' => 'ProffessorController',
        ]);
    }
    #[Route('/listprof', name: 'list_prof')]
    public function list(ManagerRegistry $em): Response
    {
        $professor = $em->getRepository(Professor::class)->findAll();
       return $this->render (
        'proffessor/list.html.twig',
        ['professor'=>$professor,]
       );
    }
    #[Route('/addprof', name: 'add_prof')]
    public function addclass(Request $req, ManagerRegistry $em):Response{
        $professor=new Professor();
        $form=$this->createForm (ProfType::class,$professor , [
            'submit_button_label' => 'Ajouter', 
        ]);

        $form -> handleRequest($req);

        if ($form -> isSubmitted()){
            $manager = $em -> getManager();
            $manager ->persist ($professor);
            $manager->flush();
            return $this->redirectToRoute('list_prof');


        }
        
        
      return $this->render(
        "proffessor/addprof.html.twig",["form"=>$form->createView()]
      );
    }
    #[Route('/updateprof/{id}', name: 'update_Prof')]
    public function updateStudent (Request $req,Professor $professor ,ManagerRegistry $em  ):Response{

        $form=$this->createForm(ProfType::class,$professor, [
            'submit_button_label' => 'Modifier', 
        ]);
        $form->handleRequest($req);
        if ($form -> isSubmitted()){
            $manager = $em ->getManager();
            $manager->persist($professor);
            $manager->flush();
            return $this->redirectToRoute('list_prof');
        }
            return $this ->renderForm("proffessor/updprof.html.twig",["form"=>$form]);
        }
        #[Route('/delprofessor/{id}', name: 'delete_Prof')]
    public function delStudent(Professor $professor, ProfessorRepository $repo):Response{
       
        $repo->remove($professor,true);
        
        
      return $this->redirectToRoute('list_prof');
    }
}
