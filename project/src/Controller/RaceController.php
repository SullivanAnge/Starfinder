<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use App\Entity\Race;

class RaceController extends AbstractController
{
    /**
     * @Route("/race", name="app_race")
     */
    

    public function index(ManagerRegistry $doctrine): Response
    {
        $races = $doctrine->getRepository(Race::class)->findAll();

        return $this->render('race/list.html.twig', [
            'races' => $races,
        ]);

        /*return $this->render('race/index.html.twig', [
            'controller_name' => 'RaceController',
        ]);*/
    }

    /**
     * @Route("/getrace/{id}")
     */
    public function getById(ManagerRegistry $doctrine,int $id)
    {
        $races = $doctrine->getRepository(Race::class)->find($id);

        $response = new Response();
        $response->setContent(json_encode([
            'titre' => $races->getTitre(),
            'texte' => $races->getText(),
            'for'=> $races->getBonusFOR(),
            'dex'=> $races->getBonusDEX(),
            'con'=> $races->getBonusCON(),
            'int'=> $races->getBonusINT(),
            'sag'=> $races->getBonusSAG(),
            'cha'=> $races->getBonusCHA(),
            'pv'=> $races->getPv(),
            'id'=> $races->getId()
        ]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

       
    }
    public function getById_class(ManagerRegistry $doctrine,int $id)
    {
        $races = $doctrine->getRepository(Race::class)->find($id);

        
        return $races;

       
    }

    public function getAll(ManagerRegistry $doctrine):array
    {
        $races = $doctrine->getRepository(Race::class)->findAll();

        return $races;
    }

    /**
     * @Route("/form_race/{id}", name="app_form_race")
     */
    public function form_race(Request $request, ManagerRegistry $doctrine,int $id=null):response
    {
        if($id){
            $race = $doctrine->getRepository(Race::class)->find($id);
        }else{
            $race = new Race();
        }
        
        $form = $this->createFormBuilder($race)
            ->add('titre')
            ->add('text',CKEditorType::class)
            ->add('bonusFOR')
            ->add('bonusDEX')
            ->add('bonusCON')
            ->add('bonusINT')
            ->add('bonusSAG')
            ->add('bonusCHA')
            ->add('bonusChoix',CheckboxType::class,['required'=>''])
            ->add('pv')
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->create_race($doctrine,$race);
            return $this->redirectToRoute('app_race');
        }


        return $this->render('race/form.html.twig',[
            'formRace' => $form->createView()
        ]);
    }

    /**
     * @Route("/form_race_del/{id}", name="app_form_race_del")
     */
    public function form_classe_del(Request $request, ManagerRegistry $doctrine,int $id):response
    {
        $race = $doctrine->getRepository(Race::class)->find($id);

        if(isset($_POST["valid_del"])){

            $this->delete_race($doctrine,$race);

            return $this->redirectToRoute('app_race');
        }

        return $this->render('race/form_del.html.twig',[
            'race' => $race
        ]);
    }

    public function create_race(ManagerRegistry $doctrine,Race $race)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->persist($race);
        $entityManager->flush();
    }

    public function delete_race(ManagerRegistry $doctrine,Race $race){
        $entityManager = $doctrine->getManager();
        $entityManager->remove($race);
        $entityManager->flush();
    }
}
