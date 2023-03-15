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

use App\Entity\Themes;


class ThemesController extends AbstractController
{
    /**
     * @Route("/themes", name="app_themes")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $themes = $doctrine->getRepository(Themes::class)->findAll();

        return $this->render('themes/list.html.twig', [
            'themes' => $themes,
        ]);

        
    }

    /**
     * @Route("/gettheme/{id}")
     */
    public function getById(ManagerRegistry $doctrine,int $id)
    {
        $themes = $doctrine->getRepository(Themes::class)->find($id);

        $response = new Response();
        $response->setContent(json_encode([
            'id' => $themes->getId(),
            'titre' => $themes->getTitre(),
            'texte' => $themes->getTxt(),
            'for'=> $themes->getBonusFOR(),
            'dex'=> $themes->getBonusDEX(),
            'con'=> $themes->getBonusCON(),
            'int'=> $themes->getBonusINT(),
            'sag'=> $themes->getBonusSAG(),
            'cha'=> $themes->getBonusCHA(),
            
        ]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
    public function getById_class(ManagerRegistry $doctrine,int $id)
    {
        $themes = $doctrine->getRepository(Themes::class)->find($id);

        
        return $themes;
        
    }

    public function getAll(ManagerRegistry $doctrine):array
    {
        $themes = $doctrine->getRepository(Themes::class)->findAll();

        return $themes;
    }

    /**
     * @Route("/form_themes/{id}", name="app_form_themes")
     */
    public function form_themes(Request $request, ManagerRegistry $doctrine,int $id=null):response
    {
        if($id){
            $theme = $doctrine->getRepository(Themes::class)->find($id);
        }else{
            $theme = new Themes();
        }
       
        $form = $this->createFormBuilder($theme)
            ->add('titre')
            ->add('txt',CKEditorType::class)
            ->add('bonusFOR')
            ->add('bonusDEX')
            ->add('bonusCON')
            ->add('bonusINT')
            ->add('bonusSAG')
            ->add('bonusCHA')
            ->add('bonusChoix',CheckboxType::class,['required'=>''])
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->create_themes($doctrine,$theme);
            return $this->redirectToRoute('app_themes');
        }


        return $this->render('themes/form.html.twig',[
            'formThemes' => $form->createView()
        ]);
    }

     /**
     * @Route("/form_theme_del/{id}", name="app_form_theme_del")
     */
    public function form_themes_del(Request $request, ManagerRegistry $doctrine,int $id):response
    {
        $theme = $doctrine->getRepository(Themes::class)->find($id);

        if(isset($_POST["valid_del"])){

            $this->delete_race($doctrine,$theme);

            return $this->redirectToRoute('app_themes');
        }

        return $this->render('themes/form_del.html.twig',[
            'theme' => $theme
        ]);
    }

    public function create_themes(ManagerRegistry $doctrine,Themes $theme)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->persist($theme);
        $entityManager->flush();
    }

    public function delete_race(ManagerRegistry $doctrine,Themes $theme){
        $entityManager = $doctrine->getManager();
        $entityManager->remove($theme);
        $entityManager->flush();
    }
}
