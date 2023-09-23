<?php
namespace Core\Infrastructure\Persistence;

require_once __DIR__ . "/../../Application/Repositories/UserRepository.php";

use Core\Domain\Entities\User;
use Core\Application\Repositories\UserRepository;
use Exception;
use PDO;

class PersistentUserRepository implements UserRepository
{
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

//    public function findById(int $id): User
//    {
//        // TODO: Implement findById() method.
//    }
//
//    public function findByUsername(string $username): User
//    {
//        // TODO: Implement findByUsername() method.
//    }

    /**
     * @throws Exception
     */
    public function createUser(User $user): User
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password_hash, email) VALUES (:username, :password, :email)");

        $username = $user->getUsername();
        $passwordHash = $user->getPassword();
        $email = $user->getEmail();

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $user->setUserId($this->db->lastInsertId()+1);
            return $user;
        } else {
            throw new Exception("User creation failed");
        }
    }

    /**
     * @throws Exception
     */
    public function getUserByUsername(string $username): User
    {
        $stmt = $this->db->prepare("
            SELECT user_id, username, email, password_hash, is_admin
            FROM users 
            WHERE username = :username
            ");

        $stmt->bindParam(':username', $username);
        if ($stmt->execute()) {
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                $user = new User();
                $user->setUserId((int) $userData['user_id']);
                $user->setUsername((string) $userData['username']);
                $user->setEmail((string) $userData['email']);
                $user->setPassword((string) $userData['password_hash']);
                $user->setIsAdmin((bool) $userData['is_admin']);
                return $user;
            }

        }
        throw new Exception("Failed to fetch user data");
    }


//    public function updateUser(User $user): User
//    {
//        // TODO: Implement updateUser() method.
//    }
//
//    public function deleteUser(int $user_id)
//    {
//        // TODO: Implement deleteUser() method.
//    }
}