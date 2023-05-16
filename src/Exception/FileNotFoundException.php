<?php

namespace App\Exception;

class FileNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('File not found');
    }
}
