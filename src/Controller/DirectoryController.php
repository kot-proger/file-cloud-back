<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\CreateDirectoryRequest;
use App\Model\DirContentListResponse;
use App\Repository\DirectoryRepository;
use App\Service\DirectoryService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Annotation\Route;

class DirectoryController extends AbstractController
{
    public function __construct(
        private DirectoryService $directoryService,
        private Security $security,
        private DirectoryRepository $directoryRepository
    )
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Create directory and return updated directory content",
     *
     *     @Model(type=DirContentListResponse::class)
     * )
     * @OA\RequestBody(@Model(type=CreateDirectoryRequest::class))
     */
    #[Route(path: '/api/v1/directories/create', methods: ['POST'])]
    public function CreateDir(#[RequestBody] CreateDirectoryRequest $createDirectoryRequest): DirContentListResponse
    {
        $this->directoryService->createDirectory($this->getParameter('kernel.project_dir').'/public/files', $createDirectoryRequest);

        return $this->directoryService->getDirContent($createDirectoryRequest->getParentDirId());
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
    public function getContentFromDir(int $dirId): DirContentListResponse
    {
        return $this->directoryService->getDirContent($dirId);
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Return user`s directory content",
     *
     *     @Model(type=DirContentListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/directories/getUsersDir', methods: ['GET'])]
    public function getUsersDir(): DirContentListResponse
    {
        $user = $this->security->getUser();
        $dir = $this->directoryRepository->findOneBy(['name' => $user->getUserIdentifier(), 'user' => $user]);
        return $this->directoryService->getDirContent($dir->getId());
    }
}
