<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationFailException extends \RuntimeException
{
    public function __construct(private ConstraintViolationListInterface $violation)
    {
        parent::__construct('Validation failed');
    }
    public function getViolation(): ConstraintViolationInterface
    {
        return $this->violation;
    }
}
