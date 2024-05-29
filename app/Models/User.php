<?php

namespace App\Models;

use PDO;

class User extends Model
{

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM users');
        return $stmt->fetchAll();
    }

    public function findByUsername(string $username): array|false
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }


    public function create(string $username, string $password, $email): int
    {
        $stmt = $this->db->prepare('INSERT INTO users (username, password, email) VALUES (:username, :password, :email)');
        $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email]);
        return $this->db->lastInsertId();
    }


}