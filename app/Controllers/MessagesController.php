<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Get;
use App\Services\MessageService;
use App\View;

#[Controller]
class MessagesController
{
    public function __construct(private MessageService $messageService)
    {
    }

    #[Get('/messages')]
    public function index(): View|string
    {
        $messages = $this->messageService->findAllMessagesWithAuthors();

        $userId = $_SESSION['user_id'] ?? null;
        $username = $_SESSION['username'] ?? 'guest';

        return View::make('messages/all', [
            'messages' => $messages,
            'user_id' => $userId,
            'username' => $username
        ]);
    }
}