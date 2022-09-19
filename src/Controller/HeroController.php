<?php

namespace App\Controller;

use App\Repository\HeroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HeroController extends AbstractController
{
    private HeroRepository $heroRepository;
    private Serializer $serializer;

    /**
     * @param HeroRepository $heroeRepository
     */
    public function __construct(HeroRepository $heroeRepository)
    {
        $this->heroRepository = $heroeRepository;
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    #[Route('/heroes', name: 'app_get_heroes')]
    public function getHeroes(): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->serialize($this->heroRepository->findAll(), 'json'),
            Response::HTTP_OK);
    }

    #[Route('/hero/{id}', name: 'app_get_hero')]
    public function getHero(Request $request): JsonResponse
    {
        $heroId = $request->get('id', null);
        if (!$heroId) {
            return $this->generateJsonErrorResponse('You must give an id!');
        }

        $hero = $this->heroRepository->find($heroId);
        if (!$hero) {
            return $this->generateJsonErrorResponse('Unable to find some hero with the given id!');
        }

        return new JsonResponse(
            $this->serializer->serialize($this->heroRepository->find($heroId), 'json'),
            Response::HTTP_OK);
    }


    #[Route('/hero/{id}/potions', name: 'app_get_hero_potions')]
    public function getHeroPotions(Request $request): JsonResponse
    {
        $heroId = $request->get('id', null);
        if (!$heroId) {
            return $this->generateJsonErrorResponse('You must give an id!');
        }

        $hero = $this->heroRepository->find($heroId);
        if (!$hero) {
            return $this->generateJsonErrorResponse('Unable to find some hero with the given id!');
        }

        return new JsonResponse(
            $this->serializer->serialize($hero->getPotions(), 'json'),
            Response::HTTP_OK);
    }

    private function generateJsonErrorResponse(string $message, int $code = Response::HTTP_BAD_REQUEST)
    {
        return new JsonResponse(
            ['code' => $code, 'message' => $message],
            $code);
    }
}
