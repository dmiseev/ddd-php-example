<?php

namespace App\Domain\ValueObject;

class EmployeeName
{
    private string $firstName;
    private string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->assertValidEmployeeName($firstName, $lastName);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    private function assertValidEmployeeName(string $firstName, string $lastName): void
    {
        if (!preg_match("/^[a-zA-Z-']+$/", $firstName) || !preg_match("/^[a-zA-Z-']+$/", $lastName)) {
            throw new \InvalidArgumentException('Invalid employee name');
        }
    }
}
