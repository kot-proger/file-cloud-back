<?php

namespace App\Exception;

class UserNotHaveAccessException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('User not have access to this file');
    }
}
