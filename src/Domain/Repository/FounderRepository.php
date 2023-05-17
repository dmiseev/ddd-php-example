<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Founder;
use App\Domain\ValueObject\Id;

interface FounderRepository
{
    public function add(Founder $entity): void;
    public function remove(Founder $entity): void;
    public function findById(Id $id): ?Founder;
    public function getNextId(): Id;
}
