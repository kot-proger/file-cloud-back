<?php

namespace App\Controller;

use App\Model\UsersListResponse;
use App\Service\UsersService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class UsersController extends AbstractController
{
    public function __construct(private UsersService $usersService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns info about users",
     *
     *     @Model(type=UsersListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/users', methods: ['GET'])]
    public function getUsers(): UsersListResponse
    {
        return $this->usersService->getUsers();
    }
}
