<?php

namespace App\Service;

use App\Entity\FileAccess;
use App\Exception\FileNotFoundException;
use App\Exception\UserNotFoundException;
use App\Exception\UserNotHaveAccessException;
use App\Model\FileAccessRequest;
use App\Repository\FileAccessRepository;
use App\Repository\FileRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;

class FileAccessService
{
    public function __construct(
        private Security $security,
        private FileAccessRepository $fileAccessRepository,
        private FileRepository $fileRepository,
        private UserRepository $userRepository
    ) {
    }

    public function setNewAccess(FileAccessRequest $fileAccessRequest)
    {
        if ($this->fileRepository->existsById($fileAccessRequest->getFileId())) {
            throw new FileNotFoundException();
        }

        if ($this->userRepository->existsById($fileAccessRequest->getUserId())) {
            throw new UserNotFoundException();
        }

        $currentUser = $this->security->getUser();
        $file = $this->fileRepository->findOneBy([], ['id' => $fileAccessRequest->getFileId()]);
        $user = $this->userRepository->findOneBy([], ['id' => $fileAccessRequest->getUserId()]);

        if ($file->getUser() === $currentUser || in_array('ROLE_ADMIN', $currentUser->getRoles())) {
            $fileAccess = (new FileAccess())
                ->setFile($file)
                ->setUser($user);

            $this->fileAccessRepository->save($fileAccess, true);
        } else {
            throw new UserNotHaveAccessException();
        }
    }

    public function deleteFileAccess(FileAccessRequest $fileAccessRequest)
    {
        if ($this->fileRepository->existsById($fileAccessRequest->getFileId())) {
            throw new FileNotFoundException();
        }

        if ($this->userRepository->existsById($fileAccessRequest->getUserId())) {
            throw new UserNotFoundException();
        }

        $currentUser = $this->security->getUser();
        $file = $this->fileRepository->findOneBy([], ['id' => $fileAccessRequest->getFileId()]);
        $user = $this->userRepository->findOneBy([], ['id' => $fileAccessRequest->getUserId()]);

        if ($file->getUser() === $currentUser || in_array('ROLE_ADMIN', $currentUser->getRoles())) {
            $fileAccess = $this->fileAccessRepository->findOneBy([], ['id' => $user->getId(), 'file' => $file->getId()]);

            $this->fileAccessRepository->remove($fileAccess, true);
        } else {
            throw new UserNotHaveAccessException();
        }
    }
}
