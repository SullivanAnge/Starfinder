<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

use App\Entity\Personnage;
use App\Controller\ClasseController;
use App\Controller\RaceController;
use App\Controller\ThemesController;
use App\Controller\CompetenceController;

class PersonnageController extends AbstractController
{
    /**
     * @Route("/personnage", name="app_personnage")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $personnages = $doctrine->getRepository(Personnage::class)->findAll();
        return $this->render('personnage/list.html.twig', [
            'controller_name' => 'PersonnageController',
            'personnages'=>$personnages,
        ]);
    }
    /**
     * @Route("/form_personnage/{id}", name="app_form_personnage")
     */
    public function form_personnage(Request $request, ManagerRegistry $doctrine,int $id=null){

        if($id){
            $personnage = $doctrine->getRepository(Personnage::class)->find($id);
        }else{
            $personnage = new Personnage();
            $personnage->setCaracFOR(10);
            $personnage->setCaracDEX(10);
            $personnage->setCaracCON(10);
            $personnage->setCaracINT(10);
            $personnage->setCaracSAG(10);
            $personnage->setCaracCHA(10);
        }

        if(isset($_POST["valid_perso"])){
            $personnage->setNom($_POST["nom"]);
            
            $personnage->setClasse(ClasseController::getById_class($doctrine,$_POST["classe"]));
            $personnage->setRace(RaceController::getById_class($doctrine,$_POST["race"]));
            $personnage->setThemes(ThemesController::getById_class($doctrine,$_POST["theme"]));

            $personnage->setCaracFOR($_POST["caracFOR"]);
            $personnage->setCaracDEX($_POST["caracDEX"]);
            $personnage->setCaracCON($_POST["caracCON"]);
            $personnage->setCaracINT($_POST["caracINT"]);
            $personnage->setCaracSAG($_POST["caracSAG"]);
            $personnage->setCaracCHA($_POST["caracCHA"]);

            $personnage->setModForce($_POST["modForce"]);
            $personnage->setModDex($_POST["modDex"]);
            $personnage->setModCon($_POST["modCon"]);
            $personnage->setModInt($_POST["modInt"]);
            $personnage->setModSag($_POST["modSag"]);
            $personnage->setModCha($_POST["modCha"]);

            $personnage->setPV($_POST["pv_total"]);
            $personnage->setPE($_POST["pe_total"]);
            $personnage->setPP(0);
            $personnage->setCAE($_POST["CAE"]);
            $personnage->setCAC($_POST["CAC"]);
            $personnage->setVigueur($_POST["vigueur"]);
            $personnage->setReflexe($_POST["reflexe"]);
            $personnage->setVolonte($_POST["volonte"]);
            $personnage->setAttCac($_POST["bonus_cac"]);
            $personnage->setAttDist($_POST["bonus_cac"]);
            $personnage->setAttLancer($_POST["bonus_lancer"]);


            
            $this->create_personnage($doctrine,$personnage);
            return $this->redirectToRoute('app_personnage');
        }

        

        $classes = ClasseController::getAll($doctrine);
        $races = RaceController::getAll($doctrine);
        $themes = ThemesController::getAll($doctrine);
        $competences = CompetenceController::getAll($doctrine);

        
        return $this->render('personnage/form.html.twig', [
            'classes' => $classes,
            'races' => $races,
            'themes' => $themes,
            'personnage'=>$personnage,
            'competences'=>$competences
        ]);
    }

    public function create_personnage(ManagerRegistry $doctrine,Personnage $personnage)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->persist($personnage);
        $entityManager->flush();
    }
}
