<?php

namespace App\Controller;

use App\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class NotificationController extends AbstractController
{
    public function __construct(private NotificationService $notificationService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Get notifications"
     * )
     */
    #[Route(path: '/api/v1/notifications', methods: 'GET')]
    public function action(): Response
    {
        return $this->json($this->notificationService->getNotifications());
    }
}
