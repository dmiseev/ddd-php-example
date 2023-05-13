<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\CompanyName;
use App\Domain\ValueObject\Id;

class Company
{
    private Id $id;
    private CompanyName $companyName;
    /**
     * @var array<\App\Domain\Entity\Employee>
     */
    private array $employees = [];

    public function __construct(
        Id $id,
        CompanyName $companyName,
    ) {
        $this->id = $id;
        $this->companyName = $companyName;
    }

    /**
     * @return \App\Domain\ValueObject\Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return \App\Domain\ValueObject\CompanyName
     */
    public function getCompanyName(): CompanyName
    {
        return $this->companyName;
    }

    public function addEmployee(Employee $employee): Company
    {
        $employeeId = $employee->getId()->getValue();
        if (!array_key_exists($employeeId, $this->employees)) {
            $this->employees[$employeeId] = $employee;
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): Company
    {
        $employeeId = $employee->getId()->getValue();
        if (array_key_exists($employeeId, $this->employees)) {
            unset($this->employees[$employeeId]);
        }

        return $this;
    }

    /**
     * @return array<\App\Domain\Entity\Employee>
     */
    public function getEmployees(): array
    {
        return $this->employees;
    }

    public function calculateAnnualSalary(): array
    {
        $totals = [];
        foreach ($this->employees as $employee) {
            if (!isset($totals[$employee->getSalary()->getCurrency()])) {
                $totals[$employee->getSalary()->getCurrency()] = 0;
            }

            $totals[$employee->getSalary()->getCurrency()] += $employee->calculateAnnualSalary()->getValue();
        }

        return $totals;
    }
}