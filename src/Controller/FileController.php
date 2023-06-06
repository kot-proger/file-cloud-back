<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\ChangeFileAccessRequest;
use App\Model\FileAccessListResponse;
use App\Model\FileAccessRequest;
use App\Model\FileListItem;
use App\Model\FileListResponse;
use App\Service\FileAccessService;
use App\Service\FileService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    public function __construct(private readonly FileService $fileService, private FileAccessService $fileAccessService)
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
    public function adminFiles(): Response
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
    public function userFiles(): Response
    {
        return $this->json($this->fileService->getUserFiles());
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns available files",
     *
     *     @Model(type=FileListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/files/available', methods: ['GET'])]
    public function availableFiles(): FileListResponse
    {
        return $this->fileService->getAvailableFiles();
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Changes access level to file",
     *
     *     @Model(type=FileListResponse::class)
     * )
     * @OA\RequestBody(@Model(type=ChangeFileAccessRequest::class))
     */
    #[Route(path: '/api/v1/files/changeAccess', methods: ['POST'])]
    public function changeAccess(#[RequestBody] ChangeFileAccessRequest $request): FileListResponse
    {
        return $this->fileService->changeAccess($request);
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Creates new access to file",
     * )
     * @OA\RequestBody(@Model(type=FileAccessRequest::class))
     */
    #[Route(path: '/api/v1/files/createAccess', methods: ['POST'])]
    public function createAccess(#[RequestBody] FileAccessRequest $request): Response
    {
        $this->fileAccessService->setNewAccess($request);

        return $this->json(['text' => 'done']);
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns accesses to file",
     *
     *     @Model(type=FileAccessListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/files/{fileId}/accesses', methods: ['GET'])]
    public function getAccess(int $fileId): FileAccessListResponse
    {
        return $this->fileAccessService->getAccesses($fileId);
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Delete access to file",
     *
     * )
     */
    #[Route(path: '/api/v1/files/deleteAccess', methods: ['DELETE'])]
    public function deleteAccess(#[RequestBody] FileAccessRequest $request): Response
    {
        $this->fileAccessService->deleteFileAccess($request);

        return $this->json(['text' => 'done']);
    }
}
