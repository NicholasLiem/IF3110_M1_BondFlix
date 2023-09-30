<?php
namespace Core\Infrastructure\Persistence;

use Core\Domain\Entities\User;
use Core\Application\Repositories\UserRepository;
use Exception;
use PDO;
use Utils\Logger\Logger;

class PersistentUserRepository implements UserRepository
{
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    public function createUser(User $user): ?User
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO users (
                    first_name, 
                    last_name, 
                    username, 
                    password_hash,
                    is_admin,
                    is_subscribed) 
                VALUES (:first_name, :last_name, :username, :password_hash, :is_admin, :is_subscribed)");

            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $username = $user->getUsername();
            $passwordHash = $user->getPasswordHash();
            $isAdmin = $user->getIsAdmin();
            $isSubscribed = $user->getIsSubscribed();

            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password_hash', $passwordHash);
            $stmt->bindParam(':is_admin', $isAdmin, PDO::PARAM_BOOL);
            $stmt->bindParam(':is_subscribed', $isSubscribed, PDO::PARAM_BOOL);

            if (!$stmt->execute()) {
                Logger::getInstance()->logMessage('User creation failed');
                throw new Exception("User creation failed");
            }

            $user->setUserId($this->getUserByUsername($username)->getUserId());
            return $user;
        } catch (Exception $e) {
            Logger::getInstance()->logMessage('User creation failed: ' . $e->getMessage());
            throw new Exception("User creation failed");
        }
    }

    /**
     * @throws Exception
     */
    public function getUserByUsername(string $username): ?User
    {
        $stmt = $this->db->prepare("
            SELECT user_id, 
                   first_name, 
                   last_name, 
                   username, 
                   password_hash, 
                   is_admin, 
                   is_subscribed
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

        return new User(
            (int) $userData['user_id'],
            $userData['first_name'],
            $userData['last_name'],
            $userData['username'],
            $userData['password_hash'],
            (bool) $userData['is_admin'],
            (bool) $userData['is_subscribed']
        );
    }

    /**
     * @throws Exception
     */
    public function updateUser(User $user): User
    {
        $stmt = $this->db->prepare("
        UPDATE users SET 
            first_name = :first_name, 
            last_name = :last_name, 
            username = :new_username, 
            password_hash = :new_password, 
            is_admin = :is_admin, 
            is_subscribed = :is_subscribed 
        WHERE user_id = :user_id");

        $newUsername = $user->getUsername();
        $newPasswordHash = $user->getPasswordHash();
        $userId = $user->getUserId();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $isAdmin = $user->getIsAdmin();
        $isSubscribed = $user->getIsSubscribed();

        $stmt->bindParam(':new_username', $newUsername);
        $stmt->bindParam(':new_password', $newPasswordHash);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':is_admin', $isAdmin);
        $stmt->bindParam(':is_subscribed', $isSubscribed);

        if (!$stmt->execute()) {
            throw new Exception("User update failed");
        }

        return $user;
    }



    /**
     * @throws Exception
     */
    public function deleteUserByUsername(int $username): void
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

    public function getAllUser(): array
    {
        try {
            $stmt = $this->db->prepare("
            SELECT user_id, 
                   first_name, 
                   last_name, 
                   username, 
                   password_hash, 
                   is_admin, 
                   is_subscribed
            FROM users
            ORDER BY user_id ASC;
        ");

            if (!$stmt->execute()) {
                throw new Exception("Database error while fetching user data");
            }

            $users = [];
            while ($userData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $user = new User(
                    (int) $userData['user_id'],
                    $userData['first_name'],
                    $userData['last_name'],
                    $userData['username'],
                    $userData['password_hash'],
                    (bool) $userData['is_admin'],
                    (bool) $userData['is_subscribed']
                );

                $users[] = $user;
            }

            return $users;
        } catch (Exception $e) {
            Logger::getInstance()->logMessage('Failed to fetch all users: ' . $e->getMessage());
            throw new Exception("Failed to fetch all users");
        }
    }
}