<?php

namespace App\Controller;

use App\Entity\DemandeGenerale;
use App\Form\DemandeGeneraleType;
use App\Repository\DemandeGeneraleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/demandegenerale')]
class DemandeGeneraleController extends AbstractController
{
    #[Route('/', name: 'app_demande_generale_index', methods: ['GET'])]
    public function index(DemandeGeneraleRepository $demandeGeneraleRepository): Response
    {
        return $this->render('demande_generale/index.html.twig', [
            'demande_generales' => $demandeGeneraleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demande_generale_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demandeGenerale = new DemandeGenerale();
        $form = $this->createForm(DemandeGeneraleType::class, $demandeGenerale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demandeGenerale);
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_generale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_generale/new.html.twig', [
            'demande_generale' => $demandeGenerale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_generale_show', methods: ['GET'])]
    public function show(DemandeGenerale $demandeGenerale): Response
    {
        return $this->render('demande_generale/show.html.twig', [
            'demande_generale' => $demandeGenerale,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demande_generale_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DemandeGenerale $demandeGenerale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandeGeneraleType::class, $demandeGenerale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_generale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_generale/edit.html.twig', [
            'demande_generale' => $demandeGenerale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_generale_delete', methods: ['POST'])]
    public function delete(Request $request, DemandeGenerale $demandeGenerale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeGenerale->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($demandeGenerale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demande_generale_index', [], Response::HTTP_SEE_OTHER);
    }
}
