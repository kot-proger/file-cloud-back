<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\UserAlreadyExistsException;
use App\Model\IdResponse;
use App\Model\SignUpRequest;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpService
{
    public function __construct(private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
        private EntityManagerInterface $em)
    {
    }

    public function signUp(SignUpRequest $signUpRequest): IdResponse
    {
        if ($this->userRepository->existsByEmail($signUpRequest->getEmail())) {
            throw new UserAlreadyExistsException();
        }

        $user = (new User())
        ->setEmail($signUpRequest->getEmail())
        ->setUsername($signUpRequest->getUsername());

        $user->setPassword($this->userPasswordHasher->hashPassword($user, $signUpRequest->getPassword()));

        $this->em->persist($user);
        $this->em->flush();

        return new IdResponse($user->getId());
    }
}
