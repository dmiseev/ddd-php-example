<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Company;
use App\Domain\ValueObject\Id;

interface CompanyRepository
{
    public function add(Company $entity): void;
    public function remove(Company $entity): void;
    public function findById(Id $id): ?Company;
    public function getNextId(): Id;
}