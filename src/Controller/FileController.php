<?php

namespace App\Controller;

use App\Model\FileListItem;
use App\Model\FileListResponse;
use App\Service\FileService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    public function __construct(private readonly FileService $fileService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns file",
     *
     *     @Model(type=FileListItem::class)
     * )
     */
    #[Route(path: '/api/v1/file', methods: ['GET'])]
    public function getfile(): Response
    {
        return $this->json($this->fileService->getFiles());
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns files",
     *
     *     @Model(type=FileListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/admin/files', methods: ['GET'])]
    public function adminLogs(): Response
    {
        return $this->json($this->fileService->getAdminFiles());
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns files",
     *
     *     @Model(type=FileListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/files', methods: ['GET'])]
    public function userLogs(): Response
    {
        return $this->json($this->fileService->getUserFiles());
    }
}
