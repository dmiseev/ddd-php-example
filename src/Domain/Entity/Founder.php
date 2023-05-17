<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Gender;
use App\Domain\ValueObject\Id;

class Founder extends User
{
    /**
     * @var array<\App\Domain\Entity\Partner>
     */
    private array $partners = [];

    public function __construct(Id $id, Email $email, Gender $gender, array $partners = [])
    {
        parent::__construct($id, $email, $gender);
        $this->partners = $partners;
    }

    /**
     * @return array<\App\Domain\Entity\Partner>
     */
    public function getPartners(): array
    {
        return $this->partners;
    }
}
