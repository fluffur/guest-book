<?php

namespace App\Services;

use App\DTO\Request;
use App\Models\Message;
use App\Models\User;
use RuntimeException;

class AuthService
{

    public function __construct(
        protected User    $userModel,
        protected Message $messageModel
    )
    {
    }

    public function processLogin(string $username, string $password): void
    {
        $this->validateCredentials($username, $password);

        $user = $this->userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new RuntimeException('Invalid username or password');
        }

        $_SESSION['user'] = $user;
    }

    public function processRegister(string $username, string $password): void
    {
        $this->validateCredentials($username, $password);

        $user = $this->userModel->findByUsername($username);

        if ($user) {
            throw new RuntimeException('Username already taken');
        }

        $id = $this->userModel->create($username, password_hash($password, PASSWORD_DEFAULT));

        $_SESSION['user'] = ['id' => $id, 'username' => $username];

    }

    private function validateCredentials(string $username, string $password): void
    {
        if (!$username || !$password) {
            throw new RuntimeException('Username or password is required');
        }
    }


}