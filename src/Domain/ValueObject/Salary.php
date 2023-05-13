<?php

namespace App\Domain\ValueObject;

class Salary
{
    const VALID_CURRENCY_LIST = [
        'USD',
    ];

    private int $value;
    private string $currency;

    public function __construct(int $value, string $currency)
    {
        $this->assertValidSalary($value, $currency);
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getValueWithCurrency(): string
    {
        return sprintf('%s %s', $this->value, $this->currency);
    }

    private function assertValidSalary(int $value, string $currency)
    {
        if ($value <= 0 && !in_array($currency, self::VALID_CURRENCY_LIST, true)) {
            throw new \InvalidArgumentException('Invalid salary');
        }
    }
}