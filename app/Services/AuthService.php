<?php

namespace App\Services;

use App\DTO\Request;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\Auth\UsernameTakenException;
use App\Exceptions\ViewNotFoundException;
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

    /**
     * @throws InvalidCredentialsException
     */
    public function processLogin(string $username, string $password): void
    {
        $this->validateCredentials($username, $password);

        $user = $this->userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new InvalidCredentialsException();
        }

        $_SESSION['user'] = $user;
    }

    /**
     * @throws InvalidCredentialsException
     * @throws UsernameTakenException
     */
    public function processRegister(string $username, string $password, string $email): void
    {
        $this->validateCredentials($username, $password);

        $user = $this->userModel->findByUsername($username);

        if ($user) {
            throw new UsernameTakenException();
        }

        $id = $this->userModel->create($username, password_hash($password, PASSWORD_DEFAULT), $email);

        $_SESSION['user'] = ['id' => $id, 'username' => $username];

    }

    /**
     * @throws InvalidCredentialsException
     */
    private function validateCredentials(string $username, string $password): void
    {
        if (!$username || !$password) {
            throw new InvalidCredentialsException('Username or password is required');
        }
    }


}