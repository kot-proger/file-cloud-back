<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\ErrorResponse;
use App\Model\SignUpRequest;
use App\Service\DirectoryService;
use App\Service\SignUpService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    public function __construct(private readonly SignUpService $signUpService)
    {
    }

    /**
     *@OA\Response(
     *     response=200,
     *     description="Signs up a user",
     * )
     *
     *@OA\Response(
     *     response=409,
     *     description="User already exists",
     *
     *     @Model(type=ErrorResponse::class)
     * )
     *
     *@OA\Response(
     *     response=400,
     *     description="Validation failed",
     *
     *     @Model(type=ErrorResponse::class)
     * )
     *
     * @OA\RequestBody(@Model(type=SignUpRequest::class))
     */
    #[Route(path: '/api/v1/auth/signUp', methods: ['POST'])]
    public function signUp(#[RequestBody] SignUpRequest $signUpRequest): Response
    {
        return $this->signUpService->signUp($signUpRequest, $this->getParameter('kernel.project_dir').'/public/files');
    }

    #[Route(path: '/api/v1/auth/logOut', methods: ['POST'])]
    public function logOut(): Response
    {
        return $this->json(['text' => 'done']);
    }
}
