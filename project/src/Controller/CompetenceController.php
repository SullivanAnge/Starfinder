<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Competence;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompetenceController extends AbstractController
{
    /**
     * @Route("/competence", name="app_competence")
     */
    public function index(ManagerRegistry $doctrine): Response
    {

        $competences = $doctrine->getRepository(Competence::class)->findAll();
       
        /*return $this->render('competence/index.html.twig', [
            'controller_name' => 'CompetenceController',
        ]);*/
        return $this->render('competence/list.html.twig',[
            'competences' => $competences
        ]);
    }

    public function getAll(ManagerRegistry $doctrine):array
    {
        $competences = $doctrine->getRepository(Competence::class)->findAll();

        return $competences;
    }
    /**
     * @Route("/form_competence/{id}",name="app_form_competence")
     */
    public function form_competence(Request $request, ManagerRegistry $doctrine,int $id=null):response
    {
        if($id){
            $competence = $doctrine->getRepository(Competence::class)->find($id);
        }else{
            $competence = new Competence();
        }
        
        $form = $this->createFormBuilder($competence)
                     ->add('titre')
                     ->add('caracteristique')
                     ->add('save', SubmitType::class, ['label' => 'Valider'])
                     ->getForm();

        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){
            
            $this->create_competence($doctrine,$competence);
            return $this->redirectToRoute('app_competence');
        }

        return $this->render('competence/form.html.twig',[
            'formCompetence' => $form->createView()
        ]);
    }

    /**
     * @Route("/competence_delete/{id}",name="app_form_competence_del")
     */
    public function form_competence_del(Request $request, ManagerRegistry $doctrine,int $id):response
    {

        $competence = $doctrine->getRepository(Competence::class)->find($id);

        if(isset($_POST["valid_del"])){

            $this->delete_competence($doctrine,$competence);

            return $this->redirectToRoute('app_competence');
        }

        return $this->render('competence/form_del.html.twig',[
            'competence' => $competence
        ]);

    }

    

    public function create_competence(ManagerRegistry $doctrine,Competence $competence)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->persist($competence);
        $entityManager->flush();
    }

    public function delete_competence(ManagerRegistry $doctrine,Competence $competence){
        $entityManager = $doctrine->getManager();
        $entityManager->remove($competence);
        $entityManager->flush();
    }

    
}
