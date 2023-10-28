<?php

namespace App\Controller;

use App\Entity\Arme;
use App\Entity\TypeArme;
use App\Form\ArmeType;
use App\Repository\ArmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\SerializerInterface;

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
     * @route("/getArmeBytype/{id}", name="get_arme_by_type", methods={"GET"})
     */
    public function getArmeBytype(ArmeRepository $armeRepository, TypeArme $typeArme, SerializerInterface $serializer)
    {
        
        $armes = $armeRepository->findByTypeArme($typeArme);
        $triArmes = [];
        
        foreach($armes as $arme){
            $triArmes[$arme->getMain()][$arme->getCategorie()?$arme->getCategorie():"Sans catégorie"][] = $arme;
        }
        
        $data = $serializer->serialize($triArmes, 'json', ['groups' => ['armes']]);
       
        return new JsonResponse($data, 200, [], true);
    }
}
