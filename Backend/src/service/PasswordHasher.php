<?php

namespace App\service;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class PasswordHasher
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function hashPassword(PasswordAuthenticatedUserInterface $user, string $password): string
    {
        return $this->passwordHasher->hashPassword($user, $password);
    }
}
