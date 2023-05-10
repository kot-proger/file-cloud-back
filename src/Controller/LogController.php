<?php

namespace App\Controller;

use App\Model\LogListResponse;
use App\Service\LogService;
use http\Env\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    #[Route(path: '/api/v1/admin/logs', methods: ['GET'])]
    public function adminLogs(): Response
    {
        return $this->json($this->logService->getAdminLogs());
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
    public function userLogs(): Response
    {
        return $this->json($this->logService->getUserLogs());
    }
}
