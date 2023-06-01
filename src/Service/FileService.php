<?php

namespace App\Service;

use App\Entity\File;
use App\Entity\FileAccess;
use App\Exception\UserNotHaveAccessException;
use App\Model\ChangeFileAccessRequest;
use App\Model\FileListItem;
use App\Model\FileListResponse;
use App\Repository\FileAccessRepository;
use App\Repository\FileRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\SecurityBundle\Security;

class FileService
{
    public function __construct(
        private FileRepository $fileRepository,
        private FileAccessRepository $fileAccessRepository,
        private Security $security)
    {
    }

    public function getFiles(): FileListResponse
    {
        $files = $this->fileRepository->findAllSortedByName();
        $items = array_map(
            [$this, 'map'],
            $files
        );

        return new FileListResponse($items);
    }

    public function getAdminFiles(): FileListResponse
    {
        $files = $this->fileRepository->findBy([], ['uploadDate' => Criteria::ASC]);
        $items = array_map(
            [$this, 'map'],
            $files
        );

        return new FileListResponse($items);
    }

    public function getUserFiles(): FileListResponse
    {
        return new FileListResponse(
            array_map([$this, 'map'],
                $this->fileRepository->findUserFiles($this->security->getUser()))
        );
    }

    private function map(File $file): FileListItem
    {
        return (new FileListItem())
        ->setId($file->getId())
        ->setName($file->getName())
        ->setSize($file->getSize())
        ->setUsername($file->getUser()->getUsername())
        ->setUploadDate($file->getUploadDate()->getTimestamp())
        ->setAccess($file->getAccess());
    }

    private function mapAccess(FileAccess $fileAccess): FileListItem
    {
        $file = $fileAccess->getFile();

        return (new FileListItem())
            ->setId($file->getId())
            ->setName($file->getName())
            ->setSize($file->getSize())
            ->setUsername($file->getUser()->getUsername())
            ->setUploadDate($file->getUploadDate()->getTimestamp())
            ->setAccess($file->getAccess());
    }

    private function getFile(int $id): FileListItem
    {
        $file = $this->fileRepository->find($id);

        return (new FileListItem())
            ->setId($file->getId())
            ->setName($file->getName())
            ->setSize($file->getSize())
            ->setUsername($file->getUser()->getUsername())
            ->setUploadDate($file->getUploadDate()->getTimestamp())
            ->setAccess($file->getAccess());
    }

    public function getAvailableFiles(): FileListResponse
    {
        $user = $this->security->getUser();

        $items = array_map([$this, 'map'],
            $this->fileRepository->findBy(['access' => 'all'])
        );

        $items = array_merge($items, array_map([$this, 'mapAccess'],
            $this->fileAccessRepository->findBy(['user' => $user])
        ));

        return new FileListResponse($items);
    }

    public function changeAccess(ChangeFileAccessRequest $request): FileListResponse
    {
        $file = $this->fileRepository->find($request->getFileId());
        $user = $this->security->getUser();

        if ($user !== $file->getUser()) {
            throw new UserNotHaveAccessException();
        }

        $file->setAccess($request->getAccess());
        $this->fileRepository->save($file, true);

        return new FileListResponse([$this->getFile($file->getId())]);
    }
}
