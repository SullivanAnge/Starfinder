<?php

namespace App\Controller;

use App\Entity\Arme;
use App\Entity\ArmePersonnage;
use App\Entity\Personnage;
use App\Form\ArmePersonnageType;
use App\Repository\ArmePersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/arme/personnage")
 */
class ArmePersonnageController extends AbstractController
{
    /**
     * @Route("/", name="app_arme_personnage_index", methods={"GET"})
     */
    public function index(ArmePersonnageRepository $armePersonnageRepository): Response
    {
        return $this->render('arme_personnage/index.html.twig', [
            'arme_personnages' => $armePersonnageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_arme_personnage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArmePersonnageRepository $armePersonnageRepository): Response
    {
        $armePersonnage = new ArmePersonnage();
        $form = $this->createForm(ArmePersonnageType::class, $armePersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $armePersonnageRepository->add($armePersonnage, true);

            return $this->redirectToRoute('app_arme_personnage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arme_personnage/new.html.twig', [
            'arme_personnage' => $armePersonnage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arme_personnage_show", methods={"GET"})
     */
    public function show(ArmePersonnage $armePersonnage): Response
    {
        return $this->render('arme_personnage/show.html.twig', [
            'arme_personnage' => $armePersonnage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_arme_personnage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ArmePersonnage $armePersonnage, ArmePersonnageRepository $armePersonnageRepository): Response
    {
        $form = $this->createForm(ArmePersonnageType::class, $armePersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $armePersonnageRepository->add($armePersonnage, true);

            return $this->redirectToRoute('app_arme_personnage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arme_personnage/edit.html.twig', [
            'arme_personnage' => $armePersonnage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arme_personnage_delete", methods={"POST"})
     */
    public function delete(Request $request, ArmePersonnage $armePersonnage, ArmePersonnageRepository $armePersonnageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$armePersonnage->getId(), $request->request->get('_token'))) {
            $armePersonnageRepository->remove($armePersonnage, true);
        }

        return $this->redirectToRoute('app_arme_personnage_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
