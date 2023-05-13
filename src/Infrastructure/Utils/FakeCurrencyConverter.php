<?php

namespace App\Infrastructure\Utils;

use App\Application\Service\CurrencyConverterInterface;

class FakeCurrencyConverter implements CurrencyConverterInterface
{
    private const COEFFICIENT = 1;

    public function convert($value, string $from, string $to): int
    {
        return $value * self::COEFFICIENT;
    }
}