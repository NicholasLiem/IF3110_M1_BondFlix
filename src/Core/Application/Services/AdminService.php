<?php

namespace Core\Application\Services;
use Core\Application\Repositories\UserRepository;

/**
 * This repository will include 4 repositories at minimum:
 * GenreRepo, CategoryRepo, DirectorRepo, ActorRepo
 */

class AdminService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    function getAllUsers() : array {
        return $this->userRepository->getAllUser();
    }

    function getUserByUsername(string $username){
        return $this->userRepository->getUserByUsername($username);
    }
}