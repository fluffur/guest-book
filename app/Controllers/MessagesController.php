<?php

namespace App\Controllers;

use App\Attributes\Controller;
use App\Attributes\Delete;
use App\Attributes\Get;
use App\Attributes\Middleware;
use App\Attributes\Post;
use App\Attributes\Put;
use App\DTO\Request;
use App\Middlewares\SessionMiddleware;
use App\Services\MessageService;
use App\View;

#[Controller]
class MessagesController
{
    public function __construct(protected MessageService $messageService)
    {
    }

    #[Get('/messages')]
    #[Middleware(SessionMiddleware::class)]
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
    #[Middleware(SessionMiddleware::class)]
    public function create(Request $request): void
    {
        $this->messageService->create($request->body['message']);

        header('Location: /messages');
    }

    #[Delete('/messages/delete')]
    #[Middleware(SessionMiddleware::class)]
    public function delete(Request $request): void
    {

        $this->messageService->delete($request->body['message_id']);
        header('Location: /messages');

    }

    #[Get('/messages/edit')]
    #[Middleware(SessionMiddleware::class)]
    public function showEdit(Request $request): View
    {
        $message = $this->messageService->findById($request->queryString['id']);
        $user = $_SESSION['user'] ?? null;
        return View::make('messages/edit', ['message' => $message, 'user' => $user]);
    }

    #[Put('/messages/edit')]
    #[Middleware(SessionMiddleware::class)]
    public function edit(Request $request): void
    {
        $this->messageService->edit($request->id, $request->message);
        header('Location: /messages');
    }

}