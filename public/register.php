<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST["username"]) || !isset($_POST["password"])) {
        die('Invalid username or password');
    }

    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    require_once '../bootstrap.php';

    $stmt = pdo()->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
    $stmt->execute([':username' => $username, ':password' => $password]);

    $userId = pdo()->lastInsertId();
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;

    header('Location: /');
}
?>

<form method="post" action="register.php">
    <label for="username">Username: </label>
    <input id="username" name="username" type="text" maxlength="255">
    <br>
    <label for="password">Password: </label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Register">
</form>

<p><a href="login.php">Login</a></p>

