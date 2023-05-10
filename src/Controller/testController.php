<?php

namespace App\Controller;

use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class testController extends AbstractController
{
    #[Route(path: '/api/v1/test/user/me', methods: ['GET'])]
    public function me(#[CurrentUser] UserInterface $user): Response
    {
        return $this->json($user);
    }
}
