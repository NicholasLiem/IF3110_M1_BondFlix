<?php
namespace Core\Application\Services;

use Core\Domain\Entities\User;
use Core\Application\Repositories\UserRepository;
use Exception;

class UserService {
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function register($username, $password, $first_name, $last_name): ?User
    {

        $user = $this->userRepository->getUserByUsername($username);

        if ($user) {
            throw new Exception("User already registered");
        }

        $user = new User();
        $user->setUsername($username);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, [12]);
        $user->setFirstName($first_name);
        $user->setLastName($last_name);
        $user->setIsAdmin(false);
        $user->setIsSubscribed(false);
        $user->setPasswordHash($hashed_password);

        return $this->userRepository->createUser($user);
    }

    /**
     * @throws Exception
     */
    public function login($username, $password): ?User
    {
        $user = $this->userRepository->getUserByUsername($username);

        if (password_verify($password, $user->getPasswordHash())){

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user->getUserId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['first_name'] = $user->getFirstName();
            $_SESSION['is_admin'] = $user->getIsAdmin();

            return $user;
        }

        /**
         * Implement fail login logic here
         */

        throw new Exception("Failed to fetch user data");
    }
}
