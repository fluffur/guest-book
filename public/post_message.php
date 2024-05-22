<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["message"])) {
    http_response_code(400);
    echo 'Invalid request.';
}

if (!isset($_SESSION["user_id"])) {
    http_response_code(401);
    echo 'You must be logged in to post a message.';
}

$message = $_POST["message"];
$user_id = $_SESSION["user_id"];

require_once '../bootstrap.php';

$stmt = pdo()->prepare('INSERT INTO user_messages (message, user_id) VALUES (:message, :user_id)');
$stmt->execute([
    ':message' => $message,
    ':user_id' => $user_id
]);

header('Location: /');
