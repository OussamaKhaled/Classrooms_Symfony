<?php

namespace App\Controller;

use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ClassType;
use App\Repository\ClassroomRepository;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/listclass', name: 'list_class')]
    public function list(ManagerRegistry $em): Response
    {
        $classroom = $em->getRepository(Classroom::class)->findAll();
       return $this->render (
        'classroom/list.html.twig',
        ['classroom'=>$classroom,]
       );
    }
    #[Route('/addclass', name: 'add_class')]
    public function addclass(Request $req, ManagerRegistry $em):Response{
        $classroom=new Classroom();
        $form=$this->createForm (ClassType::class,$classroom , [
            'submit_button_label' => 'Ajouter', 
        ]);

        $form -> handleRequest($req);

        if ($form -> isSubmitted()){
            $manager = $em -> getManager();
            $manager ->persist ($classroom);
            $manager->flush();
            return $this->redirectToRoute('list_class');


        }
        
        
      return $this->render(
        "classroom/addclass.html.twig",["form"=>$form->createView()]
      );
    }
    #[Route('/updateclass/{id}', name: 'update_Class')]
    public function updateStudent (Request $req,Classroom $classroom ,ManagerRegistry $em  ):Response{

        $form=$this->createForm(ClassType::class,$classroom, [
            'submit_button_label' => 'Modifier', 
        ]);
        $form->handleRequest($req);
        if ($form -> isSubmitted()){
            $manager = $em ->getManager();
            $manager->persist($classroom);
            $manager->flush();
            return $this->redirectToRoute('list_class');
        }
            return $this ->renderForm("classroom/updclass.html.twig",["form"=>$form]);
        }
        #[Route('/delclasroom/{id}', name: 'delete_Class')]
    public function delStudent(Classroom $classroom, ClassroomRepository $repo):Response{
       
        $repo->remove($classroom,true);
        
        
      return $this->redirectToRoute('list_class');
    }
        
        
    }
