<?php
namespace Core\Application\Services;

require __DIR__ . "/../../Domain/Entities/User.php";

use Core\Domain\Entities\User;
use Core\Application\Repositories\UserRepository;
use Exception;

class UserService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function register($username, $password, $email): User
    {
        $user = new User();
        $user->setUsername($username);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, [12]);
        $user->setPassword($hashed_password);
        $user->setEmail($email);

        return $this->userRepository->createUser($user);
    }

    /**
     * @throws Exception
     */
    public function login($username, $password, $email): User
    {
        $user = $this->userRepository->getUserByUsername($username);

        if (password_verify($password, $user->getPassword())){

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user->getUserId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['is_admin'] = $user->getIsAdmin();

            return $user;
        }

        /**
         * Implement fail login logic here
         */

        throw new Exception("Failed to fetch user data");
    }
}
