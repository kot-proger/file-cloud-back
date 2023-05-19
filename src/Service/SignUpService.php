<?php

namespace App\Service;

use App\Entity\AccessToken;
use App\Entity\Settings;
use App\Entity\User;
use App\Exception\UserAlreadyExistsException;
use App\Model\SignUpRequest;
use App\Repository\AccessTokenRepository;
use App\Repository\SettingsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use phpDocumentor\Reflection\PseudoTypes\IntegerValue;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
        private EntityManagerInterface $em,
        private AuthenticationSuccessHandler $authenticationSuccessHandler,
        private SettingsRepository $settingsRepository,
        private DirectoryService $directoryService,
        private AccessTokenRepository $accessTokenRepository,
        private Security $security)
    {
    }

    public function signUp(SignUpRequest $signUpRequest, string $baseDirectoryPath): Response
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

        $this->directoryService->createUserDirectory($user, $baseDirectoryPath);
        $response = $this->authenticationSuccessHandler->handleAuthenticationSuccess($user);

        $token = json_decode($response->getContent());
        $this->accessTokenRepository->save(
            (new AccessToken())
                ->setToken($token->{'token'})
                ->setUser($user),
            true
        );

        return $response;
    }

    public function logOut(): void
    {
        $user = $this->security->getUser();
        $accessToken = $this->accessTokenRepository->find(['user' => $user]);
        $this->accessTokenRepository->remove($accessToken, true);
    }
}
