<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints\NotBlank;

class FileAccessRequest
{
    #[NotBlank]
    private int $userId;

    #[NotBlank]
    private int $fileId;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

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
