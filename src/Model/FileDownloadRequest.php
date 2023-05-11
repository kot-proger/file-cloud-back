<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints\NotBlank;

class FileDownloadRequest
{
    #[NotBlank]
    private int $fileId;

    public function getFileId(): int
    {
        return $this->fileId;
    }

    public function setFileId(int $fileId): self
    {
        $this->fileId = $fileId;

        return $this;
    }
}
