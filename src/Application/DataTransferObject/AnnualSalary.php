<?php

namespace App\Application\DataTransferObject;

class AnnualSalary
{
    private ?int $idCompany = null;
    private ?string $currency = null;
    private ?int $salary = null;

    public static function fromArray(array $parameters): AnnualSalary
    {
        return (new AnnualSalary())
            ->setIdCompany($parameters['idCompany'] ?? null)
            ->setCurrency($parameters['currency'] ?? null)
            ->setSalary($parameters['salary'] ?? null);
    }

    public function getIdCompany(): ?int
    {
        return $this->idCompany;
    }

    public function setIdCompany(?int $idCompany): AnnualSalary
    {
        $this->idCompany = $idCompany;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): AnnualSalary
    {
        $this->currency = $currency;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(?int $salary): AnnualSalary
    {
        $this->salary = $salary;

        return $this;
    }
}
