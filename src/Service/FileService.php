<?php

namespace App\Service;

use App\Entity\File;
use App\Model\FileListItem;
use App\Model\FileListResponse;
use App\Repository\FileRepository;

class FileService
{
    public function __construct(private FileRepository $fileRepository)
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
}
