<?php

namespace Core\Application\Repositories;
use Core\Domain\Entities\User;

interface UserRepository
{
    public function createUser(User $user): ?User;
    public function getUserByUsername(string $username): ?User;
    public function updateUser(User $user): ?User;
    public function deleteUserByUsername(int $username);
}