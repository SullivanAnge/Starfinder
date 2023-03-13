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
use App\Entity\PersoCompetence;
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

        //-------------------------------Insertion personnage---------------------------------------
        if(isset($_POST["valid_perso"])){
            //on Set les différentes variables
            $personnage->setNom($_POST["nom"]); // set le nom
            $personnage->setClasse(ClasseController::getById_class($doctrine,$_POST["classe"])); //set la classe
            $personnage->setRace(RaceController::getById_class($doctrine,$_POST["race"])); //set la race
            $personnage->setThemes(ThemesController::getById_class($doctrine,$_POST["theme"])); //set le theme

            $personnage->setCaracFOR($_POST["caracFOR"]); //set la force
            $personnage->setCaracDEX($_POST["caracDEX"]); //set la dex
            $personnage->setCaracCON($_POST["caracCON"]); //set la constitution
            $personnage->setCaracINT($_POST["caracINT"]); //set l'intelligence
            $personnage->setCaracSAG($_POST["caracSAG"]); //set la sagesse
            $personnage->setCaracCHA($_POST["caracCHA"]); //set me charisme

            $personnage->setModForce($_POST["modForce"]); //set le modificateur de force
            $personnage->setModDex($_POST["modDex"]); //set le modificateur de dex
            $personnage->setModCon($_POST["modCon"]); //set le modificateur de ccnstitution
            $personnage->setModInt($_POST["modInt"]); //set le modificateur d' intelligence 
            $personnage->setModSag($_POST["modSag"]); //set le modificateur de sagesse 
            $personnage->setModCha($_POST["modCha"]); //set le modificateur de charisme

            $personnage->setPV($_POST["pv_total"]); //set les points de vie totaux
            $personnage->setPE($_POST["pe_total"]); //set les points d'endurance totaux
            $personnage->setPP(0); //set les points de persévérence
            $personnage->setCAE($_POST["CAE"]); //set la classe d'armure énergetique
            $personnage->setCAC($_POST["CAC"]); //set la classe d'armure cinétique
            $personnage->setVigueur($_POST["vigueur"]); //set la vigueur
            $personnage->setReflexe($_POST["reflexe"]); //set les reflexes
            $personnage->setVolonte($_POST["volonte"]); //set la volonte
            $personnage->setAttCac($_POST["bonus_cac"]); //set bonus attaque au corps à corps
            $personnage->setAttDist($_POST["bonus_dist"]); //set bonus attaque à distance
            $personnage->setAttLancer($_POST["bonus_lancer"]); //set bonus attaque de lancer

            //insertion personnage en bdd
            $this->create_personnage($doctrine,$personnage);
            
            //on set les valeurs de compétence du personnage
            foreach($_POST["competence"] as $key=>$competence){
                
                $competence_entity = CompetenceController::getById($doctrine,$key); //on recupère l'instance de la compétence
                //si personnage déja existant, on récupère les valeurs de compétence renseignées
                if($id){
                    $persoCompetence = $doctrine->getRepository(PersoCompetence::class)->findOneBy([
                        'personnage' => $personnage,
                        'competence' => $competence_entity
                    ]);
                //sinon on pars à 0
                }else{
                    $persoCompetence = new PersoCompetence();
                }
                
                //on set les différentes valeurs de compétence
                //si la case de compétence de classe est cochée on set a 1 sinon 0
                if (isset($competence["classe"])) {
                    $persoCompetence->setCompClasse($competence["classe"]);
                }else{
                    $persoCompetence->setCompClasse(0);
                }
                $persoCompetence->setRang($competence["rang"]); //set le rang accordé
                $persoCompetence->setBonusClasse($competence["bonus_classe"]); //set le bonus de classe (= à 3 si compétences de classe == 1)
                $persoCompetence->setModCarac($competence["mod_carac"]); //set modificateur de carac
                $persoCompetence->setModDivers($competence["mod_divers"]); //set modificateur divers
                $persoCompetence->setPersonnage($personnage); //set le personnages
                
                $persoCompetence->setCompetence($competence_entity); //set la competences associées
                $this->create_competencePerso($doctrine,$persoCompetence);
            }
            

            

            return $this->redirectToRoute('app_personnage');
        }
        //-------------fin insertion personnage-------------------------------------------------
        

        $classes = ClasseController::getAll($doctrine);
        $races = RaceController::getAll($doctrine);
        $themes = ThemesController::getAll($doctrine);
        $competences = CompetenceController::getAll($doctrine);

        if($id){
            /*foreach($competences as $competence){
                $persoCompetences[] = $doctrine->getRepository(PersoCompetence::class)->findOneBy([
                    'personnage' => $personnage,
                    'competence' => $competence
                ]);
            }*/
            

            
        }
        
       

        

        
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

    public function create_competencePerso(ManagerRegistry $doctrine,PersoCompetence $persoCompetence){
        $entityManager = $doctrine->getManager();
        $entityManager->persist($persoCompetence);
        $entityManager->flush();
    }
}
