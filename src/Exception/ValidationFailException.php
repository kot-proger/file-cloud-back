<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationFailException extends \RuntimeException
{
    public function __construct(private ConstraintViolationListInterface $violation)
    {
        parent::__construct('Validation failed');
    }

    public function getViolation(): ConstraintViolationListInterface
    {
        return $this->violation;
    }
}
