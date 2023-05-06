<?php

namespace App\Controller;

use App\Entity\Role;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(private RoleRepository $roleRepository, private EntityManagerInterface $em)
    {
    }

    #[Route('/newRole')]
    public function newRole(): Response
    {
        $role = new Role();
        $role->setName('someName');

        $this->em->persist($role);
        $this->em->flush();

        $roles = $this->roleRepository->findAll();

        return $this->json($roles);
    }

    #[Route('/')]
    public function root(): Response
    {
        $roles = $this->roleRepository->findAll();

        return $this->json($roles);
    }
}
