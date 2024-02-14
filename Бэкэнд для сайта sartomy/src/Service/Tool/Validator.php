<?php

namespace App\Service\Tool;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function count($entity): int
    {
        return count($this->validator->validate($entity));
    }

    public function errors($entity): string
    {
        return (string) $this->validator->validate($entity);
    }
}