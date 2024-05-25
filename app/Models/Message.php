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
}