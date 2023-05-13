<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\EmployeeName;
use App\Domain\ValueObject\Gender;
use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\Salary;

class Employee
{
    /**
     * @var \App\Domain\ValueObject\Id
     */
    private Id $id;
    /**
     * @var \App\Domain\ValueObject\Email
     */
    private Email $email;
    /**
     * @var \App\Domain\ValueObject\Gender
     */
    private Gender $gender;
    /**
     * @var \App\Domain\ValueObject\EmployeeName
     */
    private EmployeeName $employeeName;
    /**
     * @var \App\Domain\ValueObject\Salary
     */
    private Salary $salary;

    public function __construct(
        Id $id,
        Email $email,
        Gender $gender,
        EmployeeName $employeeName,
        Salary $salary,
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->gender = $gender;
        $this->employeeName = $employeeName;
        $this->salary = $salary;
    }

    /**
     * @return \App\Domain\ValueObject\Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return \App\Domain\ValueObject\Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return \App\Domain\ValueObject\Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @return \App\Domain\ValueObject\EmployeeName
     */
    public function getEmployeeName(): EmployeeName
    {
        return $this->employeeName;
    }

    /**
     * @return \App\Domain\ValueObject\Salary
     */
    public function getSalary(): Salary
    {
        return $this->salary;
    }

    public function calculateAnnualSalary(): Salary
    {
        return new Salary($this->getSalary()->getValue() * 12, $this->getSalary()->getCurrency());
    }
}