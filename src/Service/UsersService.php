<?php

namespace App\Service;

use App\Entity\User;
use App\Model\UsersListItem;
use App\Model\UsersListResponse;
use App\Repository\UserRepository;

class UsersService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function getUsers(): UsersListResponse
    {
        $items = array_map([$this, 'map'],
            $this->userRepository->findAll()
        );

        return new UsersListResponse($items);
    }

    private function map(User $user): UsersListItem
    {
        return (new UsersListItem())
            ->setId($user->getId())
            ->setName($user->getUsername())
            ->setEmail($user->getEmail());
    }
}
