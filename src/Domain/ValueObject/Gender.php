<?php

namespace App\Domain\ValueObject;

class Gender
{
    private const VALID_GENDER_LIST = [
        'male',
        'female',
    ];

    private string $value;

    public function __construct(string $value)
    {
        $this->assertValidGender($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function assertValidGender(string $value): void
    {
        if (!in_array($value, self::VALID_GENDER_LIST, true)) {
            throw new \InvalidArgumentException('Invalid gender');
        }
    }
}
