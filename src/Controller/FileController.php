<?php

namespace App\Controller;

use App\Service\FileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    public function __construct(private FileService $fileService)
    {
    }

    #[Route('/api/files/getFiles')]
    public function files(): Response
    {
        return $this->json($this->fileService->getFiles());
    }
}