<?php

namespace App\Domain\ValueObject;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $this->asserValidtEmail($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function asserValidtEmail(string $value)
    {
        if (!preg_match('/^[\w\-.]+@([\w-]+\.)+[\w-]{2,4}$/', $value)) {
            throw new \InvalidArgumentException('Invalid email');
        }
    }
}