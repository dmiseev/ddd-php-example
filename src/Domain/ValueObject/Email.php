<?php

namespace App\Domain\ValueObject;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $this->asserValidEmail($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function asserValidEmail(string $value): void
    {
        if (!preg_match('/^[\w\-.]+@([\w-]+\.)+[\w-]{2,4}$/', $value)) {
            throw new \InvalidArgumentException('Invalid email');
        }
    }
}
