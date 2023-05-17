<?php

namespace App\Domain\ValueObject;

class CompanyName
{
    private string $value;

    public function __construct(string $value)
    {
        $this->assertValidCompanyName($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function assertValidCompanyName(string $value): void
    {
        if (!preg_match("/^[a-zA-Z-']+$/", $value)) {
            throw new \InvalidArgumentException('Invalid company name');
        }
    }
}
