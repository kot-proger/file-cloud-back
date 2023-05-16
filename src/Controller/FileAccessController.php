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
     * @QA\RequestBody(@Model(type=FileAccessRequest::class))
     */
    #[Route(path: '/api/v1/files/setAccess')]
    public function action(#[RequestBody] FileAccessRequest $fileAccessRequest): Response
    {

        $this->fileAccessService->setNewAccess($fileAccessRequest);

        return $this->json(['done']);
    }
}
