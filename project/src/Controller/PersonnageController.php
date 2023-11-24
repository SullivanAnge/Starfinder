<?php

namespace App\Controller;

use App\Entity\Arme;
use App\Entity\ArmePersonnage;
use App\Entity\Classe;
use App\Entity\Competence;
use App\Entity\Race;
use App\Entity\Themes;
use App\Entity\TypeArme;
use App\Repository\ArmePersonnageRepository;
use App\Repository\PersoCompetenceRepository;
use App\Repository\PersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Personnage;
use App\Entity\PersoCompetence;


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
            $personnage->setPE(0);
            $personnage->setPV(0);
            $personnage->setPP(0);
            $personnage->setPointsCompetence(10);
        }

        //-------------------------------Insertion personnage---------------------------------------
        if(isset($_POST["valid_perso"])){
            //on Set les différentes variables
            $personnage->setNom($_POST["nom"]); // set le nom
           
            
            $personnage->setClasse($doctrine->getRepository(Classe::class)->find(intval($_POST["classe"]))); //set la classe
            
            $personnage->setRace($doctrine->getRepository(Race::class)->find(intval($_POST["race"]))); //set la race
            
            $personnage->setThemes($doctrine->getRepository(Themes::class)->find(intval($_POST["theme"]))); //set le theme

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
            $personnage->setBonusCae($_POST["bonus_arm_cae"]); //set le bonus d'armure énergetique 
            $personnage->setBonusCac($_POST["bonus_arm_cac"]); //set le bonus d'armure cinétique 
            $personnage->setVigueur($_POST["vigueur"]); //set la vigueur
            $personnage->setReflexe($_POST["reflexe"]); //set les reflexes
            $personnage->setVolonte($_POST["volonte"]); //set la volonte
            $personnage->setBonusVigueur($_POST["bonus_vigueur"]); //set le bonus de vigueur
            $personnage->setBonusReflexe($_POST["bonus_reflexe"]); //set le bonus de reflexes
            $personnage->setBonusVolonte($_POST["bonus_volonte"]); //set le bonus de volonte
            $personnage->setBba($_POST["bba"]); //set le bba
            $personnage->setAttCac($_POST["bonus_cac"]); //set bonus attaque au corps à corps
            $personnage->setAttDist($_POST["bonus_dist"]); //set bonus attaque à distance
            $personnage->setAttLancer($_POST["bonus_lancer"]); //set bonus attaque de lancer

            //insertion personnage en bdd
            $this->create_personnage($doctrine,$personnage);
            
            //on set les valeurs de compétence du personnage
            foreach($_POST["competence"] as $key=>$competence){
                
                $competence_entity = $doctrine->getRepository(Competence::class)->find($key); //on recupère l'instance de la compétence
                //si personnage déja existant, on récupère les valeurs de compétence renseignées
                if($id){
                    $persoCompetence = $doctrine->getRepository(PersoCompetence::class)->findOneBy([
                        'personnage' => $personnage,
                        'competence' => $competence_entity
                    ]);
                    //si personnage existant mais valeurs de compétences non renseigné, on part de 0
                    if($persoCompetence == null){
                        $persoCompetence = new PersoCompetence();
                    }
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
        

        $classes = $doctrine->getRepository(Classe::class)->findAll();
        $races = $doctrine->getRepository(Race::class)->findAll();
        $themes = $doctrine->getRepository(Themes::class)->findAll();
        $competences = $doctrine->getRepository(Competence::class)->findAll();
        $typeArme = $doctrine->getRepository(TypeArme::class)->findAll();
        $ArmePersonnage = $doctrine->getRepository(ArmePersonnage::class)->findBy(['personnage' => $personnage]);
        $TypeDegats = $doctrine->getRepository(Arme::class)->findTypeDmg();
        
        
        $persoCompetences = array();
        if($id){
            $persoCompetences_tmp = $doctrine->getRepository(PersoCompetence::class)->findBy([
                'personnage' => $personnage,
                
            ]);
            
            
            foreach($persoCompetences_tmp as $key=>$val){
               
                $persoCompetences[$val->getCompetence()->getId()] = $val;
            }
          
        }
        //dump($personnage);exit;
        return $this->render('personnage/form.html.twig', [
            'classes' => $classes,
            'races' => $races,
            'themes' => $themes,
            'personnage'=>$personnage,
            'competences'=>$competences,
            'persoCompetences'=>$persoCompetences,
            'typeArme' => $typeArme,
            'ArmePersonnage' => $ArmePersonnage,
            'TypeDegats' => $TypeDegats
        ]);
    }
    /**
    * @Route("/deletePersonnage/{id}", name="app_delete_personnage")
    */
    public function delete_personnage(Personnage $personnage,PersoCompetenceRepository $persoCompetenceRepository,PersonnageRepository $personnageRepository){
       
        $personnageRepository->delete($personnage,$persoCompetenceRepository);
        
        $response = new Response('ok', Response::HTTP_OK);
        return $response;

    }

    /**
     * @Route("/personnage/{id}/addArme/{arme}", name="app_arme_personnage_add", methods={"POST"})
     */
    public function addArme(Personnage $personnage,Arme $arme,ArmePersonnageRepository $armePersonnageRepository,SerializerInterface $serializer)
    {
        
        $armePersonnage  = new ArmePersonnage();
        $armePersonnage->setArme($arme);
        $armePersonnage->setPersonnage($personnage);
        $armePersonnage->setQty(1);

        $armePersonnageRepository->add($armePersonnage,true);
        $tabArme = [];
        $tabArme["arme"]=$arme;
        $tabArme["ArmePersonnage"]["id"]=$armePersonnage->getId();
        $tabArme["ArmePersonnage"]["qty"]=$armePersonnage->getQty();

        
        $data = $serializer->serialize($tabArme, 'json', ['groups' => ['armes']]);
        return new JsonResponse($data, 200, [], true);
        
    }
/**
     * @Route("/personnage/deleteArme/{id}", name="app_arme_personnage_delete")
     */
    public function deleteArme(ArmePersonnage $armePersonnage, ArmePersonnageRepository $armePersonnageRepository){
        $armePersonnageRepository->remove($armePersonnage,true);
        $response = new Response('ok', Response::HTTP_OK);
        return $response;
    }
    /**
     * @Route("/personnage/updtArmeQty/{id}/{qty}", name="app_arme_personnage_update_qty")
     */
    public function updtQtyArme(ArmePersonnage $armePersonnage,int $qty, ArmePersonnageRepository $armePersonnageRepository)
    {
        $armePersonnage->setQty($qty);
        $armePersonnageRepository->add($armePersonnage,true);
        $response = new Response('', Response::HTTP_OK);
        return $response;

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
