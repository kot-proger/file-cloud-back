<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    #[Route('/')]
    public function root(): Response
    {
        return $this->json(['test' => 'hello']);
    }
}