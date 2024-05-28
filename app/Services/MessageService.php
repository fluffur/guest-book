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

    public function createMessage(string $message): int
    {
        $userId = $_SESSION['user']['id'] or die('Session expired');

        return $this->messageModel->create($userId, $message);
    }

    public function delete()
    {
    }

    public function findById(int $messageId)
    {
        return $this->messageModel->findById($messageId);

    }
}