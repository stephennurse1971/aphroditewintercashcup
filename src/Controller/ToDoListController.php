<?php

namespace App\Controller;

use App\Entity\ToDoList;
use App\Form\ToDoListType;
use App\Repository\ToDoListItemsRepository;
use App\Repository\ToDoListRepository;
use App\Services\CountPendingItems;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/todolist")
 * @IsGranted("ROLE_IT")
 *
 */
class ToDoListController extends AbstractController
{
    /**
     * @Route("/index/{status}/{project}", name="to_do_list_index", methods={"GET"},defaults={"status"="Pending", "project"="All"})
     */
    public function index(ToDoListRepository $toDoListRepository, $status, $project, ToDoListItemsRepository $toDoListItemsRepository, CountPendingItems $countPendingItems): Response
    {
        $projects = $toDoListRepository->findAll();
        $project_title = 'All';

        if ($project == "Top Priority") {
            $to_do_lists_items = $toDoListItemsRepository->findBy([
                'immediatePriority' => 1
            ]);
            $project_title = "Top Priorities";

            $projects = $toDoListRepository->findAll();
//            $all_projects = $toDoListRepository->findAll();
//            $projects = [];
//            foreach ($all_projects as $project) {
//                if (CountPendingItems . calculatePendingTopPriorityItems($project) > 0) {
//                    $project = $project;
//                }
//            }

        }


        if ($project != "All" and $project != "Top Priority") {
            $projects = $toDoListRepository->findBy([
                'project' => $project
            ]);
            $to_do_lists_items = $toDoListItemsRepository->findAll();
            $project_title = $project;
        }
        if ($project == "All") {
            $projects = $toDoListRepository->findAll();
            $to_do_lists_items = $toDoListItemsRepository->findAll();
            $project_title = $project;
        }


        usort($projects, function ($first, $second) {
            return strcmp($first->getProject(), $second->getProject());
        });
        return $this->render('to_do_list/index.html.twig', [
            'status' => $status,
            'project_title' => $project_title,
            'to_do_lists' => $projects,
            'to_do_lists_items' => $to_do_lists_items,
        ]);
    }

    /**
     * @Route("/new", name="to_do_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $toDoList = new ToDoList();
        $form = $this->createForm(ToDoListType::class, $toDoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($toDoList);
            $entityManager->flush();
            return $this->redirectToRoute('to_do_list_index');
        }

        return $this->render('to_do_list/new.html.twig', [
            'to_do_list' => $toDoList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="to_do_list_show", methods={"GET"})
     */
    public function show(ToDoList $toDoList): Response
    {
        return $this->render('to_do_list/show.html.twig', [
            'to_do_list' => $toDoList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="to_do_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ToDoList $toDoList): Response
    {
        $form = $this->createForm(ToDoListType::class, $toDoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($toDoList);
            $entityManager->flush();
            return $this->redirectToRoute('to_do_list_index');
        }

        return $this->render('to_do_list/edit.html.twig', [
            'to_do_list' => $toDoList,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/view/file/{fileName}", name="to_do_list_viewfile", methods={"GET"})
     */
    public function toDoListFileLaunch(string $fileName): Response
    {
        $publicResourcesFolderPath = $this->getParameter('files_upload_default_directory');
        return new BinaryFileResponse($publicResourcesFolderPath . "/" . $fileName);
    }


    /**
     * @Route("/{id}", name="to_do_list_delete", methods={"POST"})
     */
    public function delete(Request $request, ToDoList $toDoList): Response
    {
        if ($this->isCsrfTokenValid('delete' . $toDoList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($toDoList);
            $entityManager->flush();
        }
        return $this->redirectToRoute('to_do_list_index');
    }


    /**
     * @Route("/{id}/delete/attachment", name="todolist_delete_attachment")
     */
    public function deleteAttachment(Request $request, ToDoList $toDoList, EntityManagerInterface $entityManager)
    {
        $referer = $request->headers->get('referer');
        $toDoList->setFile([]);
        $entityManager->flush();
        return $this->redirect($referer);
    }
}
