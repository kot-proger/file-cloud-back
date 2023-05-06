<?php

namespace App\Service;

use App\Entity\File;
use App\Model\FileListItem;
use App\Model\FileListResponse;
use App\Repository\FileRepository;
use Doctrine\Common\Collections\Criteria;

class FileService
{
    public function __construct(private FileRepository $fileRepository)
    {
    }

    public function getFiles(): FileListResponse
    {
        $files = $this->fileRepository->findBy([], ['name' => Criteria::ASC]);
        $items = array_map(
            fn (File $file) => new FileListItem(
                $file->getId(), $file->getName(), $file->getPath(), $file->getSize(), $file->getDate()
            ),
            $files
        );

        return new FileListResponse($items);
    }
}