<?php
session_start();
require_once '../bootstrap.php';

$pdo = pdo();

$stmt = $pdo->query('SELECT users.id as user_id, username, um.id AS message_id, user_id, message FROM users JOIN guestbook.user_messages um on users.id = um.user_id');
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>


<!-- TODO: make better styling -->


<?php if (isset($_SESSION['user_id'])): ?>

    <p>Welcome, <?= $_SESSION['username'] ?></p>
    <p><a href="logout.php">Logout</a></p>

    <form method="post" action="post_message.php">
        <label for="message">Message: </label>
        <br>
        <textarea style="resize: none"
                name="message"
                id="message"
                cols="30"
                rows="10"
                maxlength="120"
                placeholder="Write your message here"></textarea>
        <input type="submit" value="Enter message">
    </form>

<?php else: ?>

    <p><a href="login.php">Login</a></p>


<?php endif; ?>

<?php foreach ($messages as $message): ?>

    <p>Message from <?= $message['username'] . '@' . $message['user_id'] ?></p>
    <p>Content: <?= $message['message'] ?></p>
    <hr>

<?php endforeach; ?>
