<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\EmployeeName;
use App\Domain\ValueObject\Gender;
use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\Salary;

class Employee extends User
{
    private EmployeeName $employeeName;
    private Salary $salary;

    public function __construct(
        Id $id,
        Email $email,
        Gender $gender,
        EmployeeName $employeeName,
        Salary $salary,
    ) {
        parent::__construct($id, $email, $gender);

        $this->employeeName = $employeeName;
        $this->salary = $salary;
    }

    public function getEmployeeName(): EmployeeName
    {
        return $this->employeeName;
    }

    public function getSalary(): Salary
    {
        return $this->salary;
    }
}
