<?php

namespace Core\Application\Repositories;
use Core\Domain\Entities\User;

interface UserRepository
{
//    public function findById(int $id): User;
//
//    public function findByUsername(string $username): User;

    public function createUser(User $user): User;

    public function getUserByUsername(string $username): ?User;

//    public function updateUser(User $user): User;
//
//    public function deleteUser(int $user_id);
}