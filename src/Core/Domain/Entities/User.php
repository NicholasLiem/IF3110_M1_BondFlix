<?php

namespace Core\Domain\Entities;

class User
{
    private $user_id;
    private $username;
    private $email;
    private $password;
    private $is_admin;

    public function __construct(
        int $user_id = null,
        string $username = null,
        string $email = null,
        string $password = null,
        bool $is_admin = false
    ) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->is_admin = $is_admin;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIsAdmin(): bool
    {
        return $this->is_admin;
    }

    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password){
        $this->password = $password;
    }

    public function setIsAdmin(bool $is_admin){
        $this->is_admin = $is_admin;
    }
}
