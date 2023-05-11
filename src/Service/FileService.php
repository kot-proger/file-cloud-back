<?php

namespace App\Service;

use App\Entity\File;
use App\Model\FileListItem;
use App\Model\FileListResponse;
use App\Repository\FileRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\SecurityBundle\Security;

class FileService
{
    public function __construct(
        private FileRepository $fileRepository,
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
        $files = $this->fileRepository->findBy([], ['date' => Criteria::ASC]);
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
        ->setPath($file->getPath())
        ->setSize($file->getSize())
        ->setUsername($file->getUser()->getUsername())
        ->setUploadDate($file->getUploadDate()->getTimestamp());
    }

    private function getFile(int $id): FileListItem
    {
        $file = $this->fileRepository->find($id);
        return (new FileListItem())
            ->setId($file->getId())
            ->setName($file->getName())
            ->setPath($file->getPath())
            ->setSize($file->getSize())
            ->setUsername($file->getUser()->getUsername())
            ->setUploadDate($file->getUploadDate()->getTimestamp());
    }
}
