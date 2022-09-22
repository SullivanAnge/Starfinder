<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

use App\Entity\Classe;

class ClasseController extends AbstractController
{
    /**
     * @Route("/classe", name="app_classe")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $classes = $doctrine->getRepository(Classe::class)->findAll();

        return $this->render('classe/list.html.twig', [
            'classes' => $classes,
        ]);

        /*return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
        ]);*/
    }

    /**
     * @Route("/getclasse/{id}")
     */
    public function getById(ManagerRegistry $doctrine,int $id)
    {
        $classes = $doctrine->getRepository(Classe::class)->find($id);
        
        $response = new Response();
        $response->setContent(json_encode([
            'titre' => $classes->getTitre(),
            'texte' => $classes->getText(),
            'pv'=> $classes->getPv(),
            'pe'=> $classes->getPe(),
        ]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    public function getById_class(ManagerRegistry $doctrine,int $id)
    {
        $classes = $doctrine->getRepository(Classe::class)->find($id);
        
        
        return $classes;
    }
    public function getAll(ManagerRegistry $doctrine):array
    {
        $classes = $doctrine->getRepository(Classe::class)->findAll();

        return $classes;
    }

    /**
     * @Route("/form_classe/{id}", name="app_form_classe")
     */
    public function form_classe(Request $request, ManagerRegistry $doctrine,int $id=null):response
    {
        if($id){
            $classe = $doctrine->getRepository(Classe::class)->find($id);
        }else{
            $classe = new Classe();
        }
        
        $form = $this->createFormBuilder($classe)
            ->add('titre')
            ->add('text',CKEditorType::class)
            ->add('carac_e')
            ->add('pv')
            ->add('pe')
            ->add('competence_niveau')
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->create_classe($doctrine,$classe);
            return $this->redirectToRoute('app_classe');
        }


        return $this->render('classe/form.html.twig',[
            'formClasse' => $form->createView()
        ]);
    }

    /**
     * @Route("/form_classe_del/{id}", name="app_form_classe_del")
     */
    public function form_classe_del(Request $request, ManagerRegistry $doctrine,int $id):response
    {
        $classe = $doctrine->getRepository(Classe::class)->find($id);

        if(isset($_POST["valid_del"])){

            $this->delete_classe($doctrine,$classe);

            return $this->redirectToRoute('app_classe');
        }

        return $this->render('classe/form_del.html.twig',[
            'classe' => $classe
        ]);
    }

    public function create_classe(ManagerRegistry $doctrine,Classe $classe)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->persist($classe);
        $entityManager->flush();
    }

    public function delete_classe(ManagerRegistry $doctrine,Classe $classe){
        $entityManager = $doctrine->getManager();
        $entityManager->remove($classe);
        $entityManager->flush();
    }


}
