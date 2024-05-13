<?php

namespace App\Controller;

use App\Entity\Activites;
use App\Form\ActivitesType;
use App\Repository\ActivitesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/Activites')]
class ActivitesController extends AbstractController
{
    #[Route('/', name: 'app_Activites_index', methods: ['GET'])]
    public function index(ActivitesRepository $ActivitesRepository): Response
    {
        return $this->render('Activites/index.html.twig', [
            'Activites' => $ActivitesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_Activites_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activite = new Activites();
        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($activite);
            $entityManager->flush();

            return $this->redirectToRoute('app_Activites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Activites/new.html.twig', [
            'activite' => $activite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Activites_show', methods: ['GET'])]
    public function show(Activites $activite): Response
    {
        return $this->render('Activites/show.html.twig', [
            'activite' => $activite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_Activites_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activites $activite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_Activites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Activites/edit.html.twig', [
            'activite' => $activite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Activites_delete', methods: ['POST'])]
    public function delete(Request $request, Activites $activite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activite->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($activite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_Activites_index', [], Response::HTTP_SEE_OTHER);
    }
}
