<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Founder;
use App\Domain\Repository\FounderRepository;
use App\Domain\ValueObject\Id;

class FounderInMemoryRepository implements FounderRepository
{
    private array $entities = [];

    public function add(Founder $entity): void
    {
        $entityKey = $entity->getId()->getValue();
        if (!array_key_exists($entityKey, $this->entities)) {
            $this->entities[$entityKey] = $entity;
        }
    }

    public function remove(Founder $entity): void
    {
        $entityKey = $entity->getId()->getValue();
        if (array_key_exists($entityKey, $this->entities)) {
            unset($this->entities[$entityKey]);
        }
    }

    public function findById(Id $id): ?Founder
    {
        $entityKey = $id->getValue();

        return $this->entities[$entityKey] ?? null;
    }

    public function getNextId(): Id
    {
        return new Id(count($this->entities) + 1);
    }
}
