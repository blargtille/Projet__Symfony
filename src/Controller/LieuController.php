<?php

namespace App\Controller;

use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

$encoders = [new XmlEncoder(), new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);

class LieuController extends AbstractController
{

    #[Route('/lieu/{id}', name: 'lieu')]
    public function affichageLieu(int $id, LieuRepository $lieuRepository): JsonResponse
    {

        $lieu = $lieuRepository->find($id);

        if (!$lieu) {
            throw $this->createNotFoundException('Lieu non trouvé');
        }

            return $this->json([
                'nom' => $lieu->getNom(),
                'rue' => $lieu->getRue(),
                'latitude' => $lieu->getLatitude(),
                'longitude' => $lieu->getLongitude(),
                'ville' => [
                    'nom' => $lieu->getVille()->getNom(),
                    'code_postal' => $lieu->getVille()->getCodePostal(),
                ],
            ]);

        //return $this->json($jsonContent);

        }











}
