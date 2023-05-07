<?php

namespace App\Controller;

use App\Service\FileService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use App\Model\FileListResponse;

class FileController extends AbstractController
{
    public function __construct(private FileService $fileService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns files",
     *
     *     @Model(type=FileListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/files/getFiles', methods: ['GET'])]
    public function files(): Response
    {
        return $this->json($this->fileService->getFiles());
    }
}
