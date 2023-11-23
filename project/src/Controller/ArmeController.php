<?php

namespace App\Controller;

use App\Entity\Arme;
use App\Entity\TypeArme;
use App\Form\ArmeType;
use App\Repository\ArmeRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * @Route("/arme")
 */
class ArmeController extends AbstractController
{
    /**
     * @Route("/", name="app_arme_index", methods={"GET"})
     */
    public function index(ArmeRepository $armeRepository): Response
    {
        return $this->render('arme/index.html.twig', [
            'armes' => $armeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_arme_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArmeRepository $armeRepository): Response
    {
        $arme = new Arme();
        $form = $this->createForm(ArmeType::class, $arme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $armeRepository->add($arme, true);

            return $this->redirectToRoute('app_arme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arme/new.html.twig', [
            'arme' => $arme,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arme_show", methods={"GET"})
     * 
     */
    public function show(Arme $arme): Response
    {
        return $this->render('arme/show.html.twig', [
            'arme' => $arme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_arme_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Arme $arme, ArmeRepository $armeRepository): Response
    {
        $form = $this->createForm(ArmeType::class, $arme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $armeRepository->add($arme, true);

            return $this->redirectToRoute('app_arme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arme/edit.html.twig', [
            'arme' => $arme,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arme_delete", methods={"POST"})
     */
    public function delete(Request $request, Arme $arme, ArmeRepository $armeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arme->getId(), $request->request->get('_token'))) {
            $armeRepository->remove($arme, true);
        }

        return $this->redirectToRoute('app_arme_index', [], Response::HTTP_SEE_OTHER);
    }

  

    /**
     * @Route("/getArmeByFiltre/{type}/{lvl}/{TypeDmg}", name="app_arme_by_filtre", methods={"GET"})
     */
    public function getArmeByFiltre(ArmeRepository $armeRepository,SerializerInterface $serializer,$type,$lvl,$TypeDmg)
    {
       
        $armes = $armeRepository->findByFiltreArme(intval($type),intval($lvl),$TypeDmg);

        $triArmes = [];
        
        foreach($armes as $arme){
            $triArmes[$arme->getMain()][$arme->getCategorie()?$arme->getCategorie():"Sans catégorie"][] = $arme;
        }
        
        $data = $serializer->serialize($triArmes, 'json', ['groups' => ['armes']]);
       
        return new JsonResponse($data, 200, [], true);
    }



}
