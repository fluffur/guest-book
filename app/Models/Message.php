<?php

namespace App\Models;

class Message extends Model
{

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM user_messages');
        return $stmt->fetchAll();
    }

    public function findAllWithUsers(): array
    {
        $stmt = $this->db->query('SELECT * FROM user_messages JOIN users ON user_messages.user_id = users.id');
        return $stmt->fetchAll();
    }

    public function create(int $userId, string $message): int
    {
        $stmt = $this->db->prepare('INSERT INTO user_messages (user_id, message) VALUES (:userId, :message)');
        $stmt->execute(['userId' => $userId, 'message' => $message]);
        return $this->db->lastInsertId();
    }
}