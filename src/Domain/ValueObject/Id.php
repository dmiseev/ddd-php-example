<?php

namespace App\Domain\ValueObject;

class Id
{
    private int $value;

    public function __construct(int $value)
    {
        $this->assertValidId($value);
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    private function assertValidId(int $value)
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException('Wrong id');
        }
    }
}
