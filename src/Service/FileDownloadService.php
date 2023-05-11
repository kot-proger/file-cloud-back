<?php

namespace App\Service;

use App\Model\FileDownloadRequest;
use App\Model\FileDownloadResponse;
use App\Repository\FileRepository;
use App\Repository\UserRepository;
use http\Env\Response;
use Symfony\Bundle\SecurityBundle\Security;

class FileDownloadService
{
    public function __construct(
        private Security $security,
        private FileRepository $fileRepository,
        private UserRepository $userRepository)
    {
    }

    public function getFileLink(FileDownloadRequest $fileDownloadRequest): FileDownloadResponse
    {
        $user = $this->security->getUser();
        $file = $this->fileRepository->find($fileDownloadRequest->getFileId());
        $response = new FileDownloadResponse();
        $response->setLink('file not found');

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $response->setLink(implode(['/public/files', $file->getPath(), $file->getPath()]));
        }

        if (in_array('ROLE_USER', $user->getRoles())) {
            if ($user === $this->userRepository->getUser($file->getUser())) {
                $response->setLink(implode(['/public/files', $file->getPath(), $file->getPath()]));
            }
        }

        return $response;
    }
}
