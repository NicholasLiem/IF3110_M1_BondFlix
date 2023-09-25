<?php
namespace Core\Infrastructure\Persistence;

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

    /**
     * @throws Exception
     */
    public function createUser(User $user): User
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password)");

        $username = $user->getUsername();
        $passwordHash = $user->getPassword();

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $passwordHash);

        if (!$stmt->execute()) {
            throw new Exception("User creation failed");
        }

        $user->setUserId($this->getUserByUsername($username)->getUserId());
        return $user;
    }

    /**
     * @throws Exception
     */
    public function getUserByUsername(string $username): ?User
    {
        $stmt = $this->db->prepare("
            SELECT user_id, username, password_hash, is_admin
            FROM users 
            WHERE username = :username
        ");

        $stmt->bindParam(':username', $username);

        if (!$stmt->execute()) {
            throw new Exception("Database error while fetching user data");
        }

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        $user = new User();
        $user->setUserId((int) $userData['user_id']);
        $user->setUsername((string) $userData['username']);
        $user->setPassword((string) $userData['password_hash']);
        $user->setIsAdmin((bool) $userData['is_admin']);
        return $user;
    }


    /**
     * @throws Exception
     */
    public function updateUser(User $user): User
    {
        $stmt = $this->db->prepare("UPDATE users SET username = :new_username, password_hash = :new_password WHERE user_id = :user_id");

        $newUsername = $user->getUsername();
        $newPasswordHash = $user->getPassword();
        $userId = $user->getUserId();

        $stmt->bindParam(':new_username', $newUsername);
        $stmt->bindParam(':new_password', $newPasswordHash);
        $stmt->bindParam(':user_id', $userId);

        if (!$stmt->execute()) {
            throw new Exception("User update failed");
        }

        return $user;
    }


    /**
     * @throws Exception
     */
    public function deleteUserByUsername(int $username)
    {
        $stmt = $this->db->prepare("
            DELETE FROM users
            WHERE username = :username
        ");

        $stmt->bindParam(':username', $username);

        if (!$stmt->execute()) {
            throw new Exception("User deletion failed");
        }

    }
}