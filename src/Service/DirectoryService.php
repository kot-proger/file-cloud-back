<?php

namespace App\Service;

use App\Entity\Directory;
use App\Entity\File;
use App\Entity\User;
use App\Model\CreateDirectoryRequest;
use App\Model\DirContentListItem;
use App\Model\DirContentListResponse;
use App\Repository\DirectoryRepository;
use App\Repository\FileRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Filesystem\Filesystem;

class DirectoryService
{
    public function __construct(
        private Filesystem $filesystem,
        private DirectoryRepository $directoryRepository,
        private FileRepository $fileRepository,
        private Security $security)
    {
    }

    public function createBaseDir(string $path)
    {
        $this->filesystem->mkdir($path.'/files');

        $this->directoryRepository->save(
            (new Directory())
                ->setName('files')
                ->setParentDir(null)
                ->setUser(null),
            true
        );
    }

    public function createUserDirectory(User $user, string $baseDirectoryPath)
    {
        $this->filesystem->mkdir($baseDirectoryPath.'/'.$user->getEmail());

        $this->directoryRepository->save(
            (new Directory())
                ->setName($user->getEmail())
                ->setParentDir($this->directoryRepository->findOneBy(['parentDir' => null])),
            true
        );
    }

    public function createDirectory(string $baseDirectoryPath, CreateDirectoryRequest $request)
    {
        $parentDir = $this->directoryRepository->find(['id' => $request->getParentDirId()]);
        $dirPath = $parentDir->getPath();
        $this->filesystem->mkdir($baseDirectoryPath.'/'.$request->getDirName());

        $this->directoryRepository->save(
            (new Directory())
                ->setUser($this->security->getUser())
                ->setParentDir($parentDir)
                ->setName($request->getDirName()),
            true
        );
    }

    public function getDirContent(int $dirId): DirContentListResponse
    {
        $dir = $this->directoryRepository->find($dirId);

        $items = array_map([$this, 'mapDirs'],
            $this->directoryRepository->findBy(['parentDir' => $dir])
        );

        $items = array_merge($items, array_map([$this, 'mapFiles'],
            $this->fileRepository->findBy(['directory' => $dir])
        ));

        return (new DirContentListResponse())
            ->setDirId($dir->getId())
            ->setDirName($dir->getName())
            ->setItems($items);
    }

    private function mapFiles(File $file): DirContentListItem
    {
        return (new DirContentListItem())
            ->setType('file')
            ->setId($file->getId())
            ->setName($file->getName())
            ->setSize($file->getAccess())
            ->setUploadDate($file->getUploadDate()->getTimestamp())
            ->setAccess($file->getAccess());
    }

    public function mapDirs(Directory $dir): DirContentListItem
    {
        return (new DirContentListItem())
            ->setType('directory')
            ->setId($dir->getId())
            ->setName($dir->getName());
    }
}
