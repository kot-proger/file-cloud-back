<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\FileAccessRequest;
use App\Service\FileAccessService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileAccessController extends AbstractController
{
    public function __construct(private FileAccessService $fileAccessService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Add access fo file",
     * )
     *
     * @OA\RequestBody(@Model(type=FileAccessRequest::class))
     */
    #[Route(path: '/api/v1/files11/setAccess', methods: ['POST'])]
    public function setNewAccess(#[RequestBody] FileAccessRequest $fileAccessRequest): Response
    {

        $this->fileAccessService->setNewAccess($fileAccessRequest);

        return $this->json(['done']);
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Remove access fo file",
     * )
     *
     * @OA\RequestBody(@Model(type=FileAccessRequest::class))
     */
    #[Route(path: '/api/v1/files11/removeAccess', methods: ['DELETE'])]
    public function removeAccess(#[RequestBody] FileAccessRequest $fileAccessRequest): Response
    {

        $this->fileAccessService->deleteFileAccess($fileAccessRequest);

        return $this->json(['done']);
    }
}
