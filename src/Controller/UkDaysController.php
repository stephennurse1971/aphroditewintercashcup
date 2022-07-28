<?php

namespace App\Controller;

use App\Entity\UkDays;
use App\Form\UkDaysType;
use App\Repository\UkDaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/uk/days")
 */
class UkDaysController extends AbstractController
{
    /**
     * @Route("/", name="uk_days_index", methods={"GET"})
     */
    public function index(UkDaysRepository $ukDaysRepository): Response
    {
        return $this->render('uk_days/index.html.twig', [
            'uk_days' => $ukDaysRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="uk_days_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ukDay = new UkDays();
        $form = $this->createForm(UkDaysType::class, $ukDay);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

        if (date_diff($ukDay->getStartDate(), $ukDay->getEndDate())->format("%r%a") < 0) {
            return $this->render('uk_days/new.html.twig', [
                'uk_day' => $ukDay,
                'form' => $form->createView(),
                'error' => 'End Date Cannot be less then Start Date.'
            ]);
        }
    }
        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('travelDocs')->getData()) {
                $days = $ukDay->getEndDate()->diff($ukDay->getStartDate())->days;
                $ukDay->setDayCount($days);
                $files = $form->get('travelDocs')->getData();
                $file_names = [];
                foreach ($files as $file) {
                    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = $originalFilename . "." . $file->guessExtension();
                    $file->move(
                        $this->getParameter('files_upload_default_directory'),
                        $newFilename
                    );
                    $file_names[] = $newFilename;
                }
                $ukDay->setTravelDocs($file_names);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ukDay);
            $entityManager->flush();

            return $this->redirectToRoute('uk_days_index');
        }

        return $this->render('uk_days/new.html.twig', [
            'uk_day' => $ukDay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="uk_days_show", methods={"GET"})
     */
    public function show(UkDays $ukDay): Response
    {
        return $this->render('uk_days/show.html.twig', [
            'uk_day' => $ukDay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="uk_days_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UkDays $ukDay): Response
    {
        $form = $this->createForm(UkDaysType::class, $ukDay);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if (date_diff($ukDay->getStartDate(), $ukDay->getEndDate())->format("%r%a") < 0) {
                return $this->render('uk_days/edit.html.twig', [
                    'uk_day' => $ukDay,
                    'form' => $form->createView(),
                    'error' => 'End Date Cannot be less then Start Date.'
                ]);
            }
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $days = $ukDay->getEndDate()->diff($ukDay->getStartDate())->days;
            $ukDay->setDayCount($days);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('uk_days_index');
        }

        return $this->render('uk_days/edit.html.twig', [
            'uk_day' => $ukDay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="uk_days_delete", methods={"POST"})
     */
    public function delete(Request $request, UkDays $ukDay): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ukDay->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ukDay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('uk_days_index');
    }
}
