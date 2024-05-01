<?php

namespace App\Controller;

use App\Entity\Statut;
use App\Form\StatutType;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/Statut')]
class StatutController extends AbstractController
{
    #[Route('/', name: 'app_Statut_index', methods: ['GET'])]
    public function index(StatutRepository $StatutRepository): Response
    {
        return $this->render('Statut/index.html.twig', [
            'Statuts' => $StatutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_Statut_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $Statut = new Statut();
        $form = $this->createForm(StatutType::class, $Statut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($Statut);
            $entityManager->flush();

            return $this->redirectToRoute('app_Statut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Statut/new.html.twig', [
            'Statut' => $Statut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Statut_show', methods: ['GET'])]
    public function show(Statut $Statut): Response
    {
        return $this->render('Statut/show.html.twig', [
            'Statut' => $Statut,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_Statut_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Statut $Statut, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StatutType::class, $Statut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_Statut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Statut/edit.html.twig', [
            'Statut' => $Statut,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_Statut_delete', methods: ['POST'])]
    public function delete(Request $request, Statut $Statut, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Statut->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($Statut);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_Statut_index', [], Response::HTTP_SEE_OTHER);
    }
}
