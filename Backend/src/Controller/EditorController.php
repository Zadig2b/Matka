<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\VoyageType;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('editor/voyage')]
class EditorController extends AbstractController
{
    private SecurityBundleSecurity $security;

    public function __construct(SecurityBundleSecurity $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'editor_voyage_index')]
    public function myVoyages(VoyageRepository $voyageRepository): Response
    {
        // Get the authenticated user
        $user = $this->getUser();
    
        // If the user is not authenticated, handle accordingly (e.g., redirect to login)
        if (!$user) {
            // Handle unauthenticated user
            // For example, redirect to login page
            return $this->redirectToRoute('app_login');
        }
    
        // Get voyages associated with the authenticated user
        $voyages = $voyageRepository->findBy(['voyage_user' => $user]);
    
        return $this->render('voyage/index_mes_voyages.html.twig', [
            'voyages' => $voyages
        ]);
    }

    #[Route('/from-others', name: 'show_travel_from_others')]
    public function showTravelFromOthers(VoyageRepository $voyageRepository): Response
    {
        // Retrieve the authenticated user
        $editor = $this->getUser();
    
        // Retrieve voyages created by other users
        $voyage = $voyageRepository->findVoyagesFromOthers($editor);
    
        // Render the Twig view to display the voyages
        return $this->render('voyage/index_from_others.html.twig', [
            'voyages' => $voyage,
        ]);
    }

    #[Route('/new', name: 'editor_voyage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voyage = new Voyage();
        
        // Get the authenticated user
        $user = $this->security->getUser();
        
        // Set the authenticated user as the voyage_user
        $voyage->setVoyageUser($user);
        
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voyage);
            $entityManager->flush();

            return $this->redirectToRoute('app_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyage/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'editor_voyage_show', methods: ['GET'])]
    public function show(Voyage $voyage): Response{
        return $this->render('voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    #[Route('/{id}/edit', name: 'editor_voyage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voyage $voyage, EntityManagerInterface $entityManager): Response
    {
        // Get the authenticated user
        $user = $this->security->getUser();

        // Check if authenticated user is the same as the voyage_user
        if ($user !== $voyage->getVoyageUser()) {
            throw $this->createAccessDeniedException('You are not allowed to edit this voyage.');
        }

        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('editor_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'editor_voyage_delete', methods: ['POST'])]
    public function delete(Request $request, Voyage $voyage, EntityManagerInterface $entityManager): Response
    {
        // Get the authenticated user
        $user = $this->security->getUser();

        // Check if authenticated user is the same as the voyage_user
        if ($user !== $voyage->getVoyageUser()) {
            throw $this->createAccessDeniedException('You are not allowed to delete this voyage.');
        }
        // Check if the CSRF token is valid
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('editor_voyage_index', [], Response::HTTP_SEE_OTHER);
    }
    

}