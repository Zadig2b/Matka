<?php

namespace App\Controller\API;

use App\Entity\Demande;
use App\Entity\DemandeGenerale;
use App\Entity\Statut;
use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'api_')]

class ApiController extends AbstractController
{
    #[Route('/voyages', name: 'voyages')]
    public function index(VoyageRepository $voyageRepository): Response
    {
        $voyages = $voyageRepository->findAll();
        return $this->json($voyages, context: ['groups' => 'api_voyage_methods']);;
    }

    #[Route('/voyage/{nom}', name: 'detailvoyage2', methods: ['GET'])]
    public function getDetailVoyage2(string $nom, SerializerInterface $serializer, VoyageRepository $voyageRepository): JsonResponse
    {
        $voyage = $voyageRepository->findOneBy(['nom' => $nom]);

        if (!$voyage) {
            throw $this->createNotFoundException('Voyage not found');
        }

        $jsonVoyage = $serializer->serialize($voyage, 'json', ['groups' => 'api_voyage_methods']);

        return new JsonResponse($jsonVoyage, Response::HTTP_OK, [], true);
    }

    #[Route('/voyage/{id}', name: 'detailvoyage', methods: ['GET'])]
    public function getDetailvoyage(int $id, SerializerInterface $serializer, VoyageRepository $voyageRepository): JsonResponse
    {

        $voyage = $voyageRepository->find($id);
        if ($voyage) {
            $jsonvoyage = $serializer->serialize($voyage, 'json', ['groups' => 'api_voyage_methods']);
            return new JsonResponse($jsonvoyage, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/demande/new', name: 'demande_new', methods: ['POST'])]
    public function saveDemande(
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        // Deserialize JSON payload into Demande entity
        $demande = $serializer->deserialize(
            $request->getContent(),
            Demande::class,
            'json',
            ['groups' => 'api_nouvelle_demande']
        );

        // Validate the Demande entity
        $errors = $validator->validate($demande);

        // If there are validation errors, return them
        if ($errors->count()) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Retrieve the voyage_id from the request
        $data = json_decode($request->getContent(), true);
        $voyageId = $data['voyage_id'] ?? null;

        // If voyage_id is provided, associate Demande with the corresponding Voyage
        if ($voyageId) {
            // Fetch the Voyage entity by its ID
            $voyage = $em->getRepository(Voyage::class)->find($voyageId);

            // If no Voyage found, return error
            if (!$voyage) {
                return $this->json(['error' => 'Voyage not found'], Response::HTTP_NOT_FOUND);
            }

            // Associate Demande with Voyage
            $demande->setVoyage($voyage);
        }

        // If Statut is not set, set a default value
        if (!$demande->getStatut()) {
            // Set a default value for the 'Statut' property
            // You may fetch the default status entity from the database or set it manually
            $defaultStatut = $em->getRepository(Statut::class)->find(1); // Assuming '1' is the ID of the default status
            $demande->setStatut($defaultStatut);
        }

        // Persist and flush Demande entity
        $em->persist($demande);
        $em->flush();

        // Return success response
        return $this->json(['message' => 'Demande saved successfully'], Response::HTTP_CREATED);
    }

    #[Route('/demandegenerale/new', name: 'demandegenerale_new', methods: ['POST'])]
    public function saveDemandeGenerale(
    Request $request, 
    EntityManagerInterface $em, 
    SerializerInterface $serializer, 
    ValidatorInterface $validator)
    {
        // Deserialize the request content into a DemandeGenerale object
        $demandeGenerale = $serializer->deserialize(
            $request->getContent(), 
        DemandeGenerale::class,
         'json', 
         ['groups' => 'api_demande_generale']);

                 // Validate the DemandeGenerale object
        $errors = $validator->validate($demandeGenerale);

        // Check if there are validation errors
        if (count($errors) > 0) {
            // Prepare error messages
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            // Return validation errors
            return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Check if the 'Statut' property is not set in the request payload
        if (!$demandeGenerale->getStatut()) {
            // Set a default value for the 'Statut' property
            // You may fetch the default status entity from the database or set it manually
            $defaultStatut = $em->getRepository(Statut::class)->find(1); // Assuming '1' is the ID of the default status
            $demandeGenerale->setStatut($defaultStatut);
        }

        // Persist the DemandeGenerale object
        $em->persist($demandeGenerale);
        $em->flush();

        // Return the persisted DemandeGenerale object
        return $this->json(['message' => 'Demande saved successfully'], Response::HTTP_CREATED);
    }

}
