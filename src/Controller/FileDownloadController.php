<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\FileDownloadRequest;
use App\Model\FileDownloadResponse;
use App\Service\FileDownloadService;
use http\Env\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FileDownloadController extends AbstractController
{
    public function __construct(private FileDownloadService $downloadService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Some description",
     * )
     *
     * @OA\RequestBody(@Model(type=FileDownloadRequest::class))
     */
    #[Route(path: '/api/v1/files/download', methods: ['GET'])]
    public function action(#[RequestBody] FileDownloadRequest $fileDownloadRequest): JsonResponse
    {
        return $this->json($this->downloadService->getFileLink($fileDownloadRequest));
    }
}
