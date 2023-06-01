<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\CreateDirectoryRequest;
use App\Model\DirContentListResponse;
use App\Service\DirectoryService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class DirectoryController extends AbstractController
{
    public function __construct(private DirectoryService $directoryService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Create directory and return updated directory content",
     *
     *     @Model(type=DirContentListResponse::class)
     *
     * @OA\RequestBody(@Model(type=CreateDirectoryRequest::class))
     * )
     */
    #[Route(path: '/api/v1/directories/create', methods: ['POST'])]
    public function Create(#[RequestBody] CreateDirectoryRequest $request): DirContentListResponse
    {
        $this->directoryService->createDirectory($this->getParameter('kernel.project_dir').'/public/files', $request);

        return $this->directoryService->getDirContent($request->getParentDirId());
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Return directory content",
     *
     *     @Model(type=DirContentListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/directories/{dirId}/getContent', methods: ['GET'])]
    public function getContent(int $dirId): DirContentListResponse
    {
        return $this->directoryService->getDirContent($dirId);
    }
}
