<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\DirectoryRepository;
use Symfony\Component\Filesystem\Filesystem;

class DirectoryService
{
    public function __construct(
        private Filesystem $filesystem,
        /*private DirectoryRepository $directoryRepository*/)
    {
    }

    public function createUserDirectory(User $user, string $baseDirectoryPath)
    {
        $this->filesystem->mkdir($baseDirectoryPath.'/'.$user->getEmail());


    }
}
