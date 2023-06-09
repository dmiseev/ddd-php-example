<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\CompanyName;
use App\Domain\ValueObject\Id;

class Company
{
    private Id $id;
    private CompanyName $companyName;
    private Founder $founder;

    /**
     * @var array<\App\Domain\Entity\Employee>
     */
    private array $employees = [];

    public function __construct(
        Id $id,
        CompanyName $companyName,
        Founder $founder
    ) {
        $this->id = $id;
        $this->companyName = $companyName;
        $this->founder = $founder;
    }

    public function getFounder(): Founder
    {
        return $this->founder;
    }

    public function getId(): Id
    {
        return $this->id;
    }

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

    /**
     * @return array<int, \App\Domain\ValueObject\Salary>
     */
    public function getEmployeeSalaries(): array
    {
        $salaries = [];
        foreach ($this->employees as $employee) {
            $salaries[] = $employee->getSalary();
        }

        return $salaries;
    }
}
