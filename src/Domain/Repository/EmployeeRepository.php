<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Employee;
use App\Domain\ValueObject\Id;

interface EmployeeRepository
{
    public function add(Employee $entity): void;
    public function remove(Employee $entity): void;
    public function findById(Id $id): ?Employee;
    public function getNextId(): Id;
}
