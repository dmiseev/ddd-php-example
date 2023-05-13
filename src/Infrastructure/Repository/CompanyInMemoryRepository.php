<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Company;
use App\Domain\Repository\CompanyRepository;
use App\Domain\ValueObject\Id;

class CompanyInMemoryRepository implements CompanyRepository
{
    private array $entities = [];

    public function add(Company $entity): void
    {
        $entityKey = $entity->getId()->getValue();
        if (!array_key_exists($entityKey, $this->entities)) {
            $this->entities[$entityKey] = $entity;
        }
    }

    public function remove(Company $entity): void
    {
        $entityKey = $entity->getId()->getValue();
        if (array_key_exists($entityKey, $this->entities)) {
            unset($this->entities[$entityKey]);
        }
    }

    public function findById(Id $id): ?Company
    {
        $entityKey = $id->getValue();

        return $this->entities[$entityKey] ?? null;
    }

    public function getNextId(): Id
    {
        return new Id(count($this->entities) + 1);
    }
}