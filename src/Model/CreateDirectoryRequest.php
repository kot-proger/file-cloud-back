<?php

namespace App\Model;

class CreateDirectoryRequest
{
    private string $dirName;

    private int $parentDirId;

    public function getDirName(): string
    {
        return $this->dirName;
    }

    public function setDirName(string $dirName): self
    {
        $this->dirName = $dirName;

        return $this;
    }

    public function getParentDirId(): int
    {
        return $this->parentDirId;
    }

    public function setParentDirId(int $parentDirId): self
    {
        $this->parentDirId = $parentDirId;

        return $this;
    }


}
