<?php

namespace App\Services;

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

    public function processLogin(): void
    {
        [$username, $password] = $this->parseLoginFormRequest();

        $user = $this->userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new RuntimeException('Invalid username or password');
        }

        $_SESSION['user'] = $user;
    }

    public function processRegister(): void
    {
        [$username, $password] = $this->parseLoginFormRequest();

        $user = $this->userModel->findByUsername($username);

        if ($user) {
            throw new RuntimeException('Username already taken');
        }

        $id = $this->userModel->create($username, password_hash($password, PASSWORD_DEFAULT));

        $_SESSION['user'] = ['id' => $id, 'username' => $username];

    }

    private function parseLoginFormRequest(): array
    {
        $username = $_POST['username'] ?? false;
        $password = $_POST['password'] ?? false;

        if (!$username || !$password) {
            throw new RuntimeException('Username or password is required');
        }

        return [$username, $password];

    }


}