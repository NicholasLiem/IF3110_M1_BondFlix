<?php
namespace Core\Application\Services;

require __DIR__ . "/../../Domain/Entities/User.php";

use Core\Domain\Entities\User;
use Core\Application\Repositories\UserRepository;

class UserService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function registerUser($username, $password, $email): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);

        return $this->userRepository->createUser($user);
    }
}
