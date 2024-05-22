<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST["username"]) || !isset($_POST["password"])) {
        die('Invalid credentials');
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once '../bootstrap.php';

    $stmt = pdo()->prepare('SELECT id, username, password FROM users WHERE username = ?');
    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        die('Invalid credentials');
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: /');
}

?>

<form method="post" action="login.php">
    <label for="username">Username: </label>
    <input id="username" name="username" type="text" maxlength="255">
    <br>
    <label for="password">Password: </label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Log in">
</form>

<p><a href="register.php">Register</a></p>
