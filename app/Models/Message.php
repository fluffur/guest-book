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
        $stmt = $this->db->query('SELECT users.id user_id, user_messages.id message_id, username, message FROM user_messages JOIN users ON user_messages.user_id = users.id');
        return $stmt->fetchAll();
    }

    public function create(int $userId, string $message): int
    {
        $stmt = $this->db->prepare('INSERT INTO user_messages (user_id, message) VALUES (:userId, :message)');
        $stmt->execute(['userId' => $userId, 'message' => $message]);
        return $this->db->lastInsertId();
    }

    public function findById(int $messageId): array
    {
        $stmt = $this->db->prepare('SELECT id message_id, message, user_id FROM user_messages WHERE id = :message_id');
        $stmt->execute(['message_id' => $messageId]);
        return $stmt->fetch();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM user_messages WHERE id = :message_id');
        return $stmt->execute([':message_id' => $id]);

    }

    public function edit(int $id, string $newMessage): bool
    {
        $stmt = $this->db->prepare('UPDATE user_messages SET message = :message WHERE id = :message_id');
        return $stmt->execute([':message' => $newMessage, ':message_id' => $id]);

    }
}