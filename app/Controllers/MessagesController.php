<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Delete;
use App\Attributes\Get;
use App\Attributes\Post;
use App\DTO\Request;
use App\Services\MessageService;
use App\View;

#[Controller]
class MessagesController
{
    public function __construct(protected MessageService $messageService)
    {
    }

    #[Get('/messages')]
    public function index(Request $request): View|string
    {
        $messages = $this->messageService->findAllMessagesWithAuthors();

        $user = $_SESSION['user'] ?? null;
        return View::make('messages/all', [
            'messages' => $messages,
            'user' => $user
        ]);
    }

    #[Post('/messages/new')]
    public function create(Request $request): void
    {
        $messageId = $this->messageService->createMessage($request->body['message']);

        header('Location: /messages');

    }


}