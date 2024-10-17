<?php

namespace App\Controller;

use App\Entity\BusinessTypes;
use App\Form\BusinessTypesType;
use App\Repository\BusinessTypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/business/types")
 */
class BusinessTypesController extends AbstractController
{
    /**
     * @Route("/", name="business_types_index", methods={"GET"})
     */
    public function index(BusinessTypesRepository $businessTypesRepository): Response
    {
        return $this->render('business_types/index.html.twig', [
            'business_types' => $businessTypesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="business_types_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BusinessTypesRepository $businessTypesRepository): Response
    {
        $businessType = new BusinessTypes();
        $form = $this->createForm(BusinessTypesType::class, $businessType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessTypesRepository->add($businessType, true);

            return $this->redirectToRoute('business_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('business_types/new.html.twig', [
            'business_type' => $businessType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="business_types_show", methods={"GET"})
     */
    public function show(BusinessTypes $businessType): Response
    {
        return $this->render('business_types/show.html.twig', [
            'business_type' => $businessType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="business_types_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BusinessTypes $businessType, BusinessTypesRepository $businessTypesRepository): Response
    {
        $form = $this->createForm(BusinessTypesType::class, $businessType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessTypesRepository->add($businessType, true);

            return $this->redirectToRoute('business_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('business_types/edit.html.twig', [
            'business_type' => $businessType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="business_types_delete", methods={"POST"})
     */
    public function delete(Request $request, BusinessTypes $businessType, BusinessTypesRepository $businessTypesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$businessType->getId(), $request->request->get('_token'))) {
            $businessTypesRepository->remove($businessType, true);
        }

        return $this->redirectToRoute('business_types_index', [], Response::HTTP_SEE_OTHER);
    }
}
