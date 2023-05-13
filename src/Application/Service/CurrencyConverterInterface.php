<?php

namespace App\Application\Service;

interface CurrencyConverterInterface
{
    public function convert($value, string $from, string $to): int;
}
