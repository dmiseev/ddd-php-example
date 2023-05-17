<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Gender;
use App\Domain\ValueObject\Id;

class User
{
    protected Id $id;
    protected Email $email;
    protected Gender $gender;

    public function __construct(Id $id, Email $email, Gender $gender)
    {
        $this->id = $id;
        $this->email = $email;
        $this->gender = $gender;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getGender(): Gender
    {
        return $this->gender;
    }
}
