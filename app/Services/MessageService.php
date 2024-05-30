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
        return array_reverse($this->messageModel->findAllWithUsers());
    }

    public function create(string $message): int
    {
        $userId = $_SESSION['user']['id'] or die('Session expired');

        return $this->messageModel->create($userId, $message);
    }

    public function delete(int $id): bool
    {
        return $this->messageModel->delete($id);
    }

    public function findById(int $id)
    {
        return $this->messageModel->findById($id);
    }

    public function edit(int $id, string $newMessage)
    {
        $this->messageModel->edit($id, $newMessage);
    }

}