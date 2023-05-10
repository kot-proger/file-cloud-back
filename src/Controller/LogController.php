<?php

namespace App\Controller;

use App\Service\LogService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use App\Model\LogListResponse;

class LogController extends AbstractController
{
    public function __construct(private LogService $logService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Some description",
     *
     *     @Model(type=LogListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/logs', methods: ['GET'])]
    public function files(): Response
    {
        return $this->json($this->logService->getFiles());
    }
}
