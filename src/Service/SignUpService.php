<?php

namespace App\Service;

use App\Entity\Settings;
use App\Entity\User;
use App\Exception\UserAlreadyExistsException;
use App\Model\SignUpRequest;
use App\Repository\SettingsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
        private EntityManagerInterface $em,
        private AuthenticationSuccessHandler $authenticationSuccessHandler,
        private Filesystem $filesystem,
        private SettingsRepository $settingsRepository)
    {
    }

    public function signUp(SignUpRequest $signUpRequest): Response
    {
        if ($this->userRepository->existsByEmail($signUpRequest->getEmail())) {
            throw new UserAlreadyExistsException();
        }

        $user = (new User())
            ->setRoles(['ROLE_USER'])
            ->setEmail($signUpRequest->getEmail())
            ->setUsername($signUpRequest->getUsername());

        $user->setPassword($this->userPasswordHasher->hashPassword($user, $signUpRequest->getPassword()));

        $this->em->persist($user);
        $this->em->flush();

        $settings = (new Settings())->setUser($user);
        $this->settingsRepository->save($settings, true);

        return $this->authenticationSuccessHandler->handleAuthenticationSuccess($user);
    }
}
