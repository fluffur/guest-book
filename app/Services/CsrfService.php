<?php

namespace App\Services;

class CsrfService
{

    public function generateToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public function getToken()
    {

        return $_SESSION['csrf_token'] ?? null;
    }

    public function validateToken(string $token): bool {
        return hash_equals($this->getToken(), $token);
    }
}