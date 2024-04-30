<?php

namespace App\Controller\API;

use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api')]

class ApiController extends AbstractController
{
    #[Route('s', name: 'index')]
    public function index(VoyageRepository $voyageRepository): Response
    {
        $voyages = $voyageRepository->findAll();
        return $this->json($voyages, context: ['groups' => 'api_voyage_index']);
        ;
    }
    #[Route('/{id}', name: 'detailvoyage', methods: ['GET'])]
    public function getDetailvoyage(int $id, SerializerInterface $serializer, VoyageRepository $voyageRepository): JsonResponse {

        $voyage = $voyageRepository->find($id);
        if ($voyage) {
            $jsonvoyage = $serializer->serialize($voyage, 'json');
            return new JsonResponse($jsonvoyage, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
   }
}
