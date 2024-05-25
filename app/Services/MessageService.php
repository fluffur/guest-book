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
}