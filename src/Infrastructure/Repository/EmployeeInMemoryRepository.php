<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Employee;
use App\Domain\Repository\EmployeeRepository;
use App\Domain\ValueObject\Id;

class EmployeeInMemoryRepository implements EmployeeRepository
{
    private array $entities = [];

    public function add(Employee $entity): void
    {
        $entityKey = $entity->getId()->getValue();
        if (!array_key_exists($entityKey, $this->entities)) {
            $this->entities[$entityKey] = $entity;
        }
    }

    public function remove(Employee $entity): void
    {
        $entityKey = $entity->getId()->getValue();
        if (array_key_exists($entityKey, $this->entities)) {
            unset($this->entities[$entityKey]);
        }
    }

    public function findById(Id $id): ?Employee
    {
        $entityKey = $id->getValue();

        return $this->entities[$entityKey] ?? null;
    }

    public function getNextId(): Id
    {
        return new Id(count($this->entities) + 1);
    }
}