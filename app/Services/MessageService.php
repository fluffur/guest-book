<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function __construct(private Message $messageModel)
    {
    }

    public function findAllMessagesWithAuthors(): array
    {
        return $this->messageModel->findAllWithUsers();
    }

    public function createMessage(): int
    {
        $userId = $_SESSION['user']['id'] or die('Session expired');
        $message = $_POST['message'] ?? '';

        return $this->messageModel->create($userId, $message);
    }
}