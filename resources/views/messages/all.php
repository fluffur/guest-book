
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
</head>
<body>
<header>
    <h1>Guest book</h1>
    <nav>
        <ul>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
            <li><a href="/messages">Show messages</a></li>
        </ul>
    </nav>
</header>
<main>

    <?php if (isset($user_id)): ?>

        <p>Welcome, <?= $user_id ?></p>
        <p><a href="/logout">Logout</a></p>

        <form method="post" action="/messages/new">
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

        <p>To send a message you must be <a href="/login">logged in</a>.</p>


    <?php endif; ?>

    <?php foreach ($messages as $message): ?>
        <p>Message from <?= $message['username'] . '@' . $message['user_id'] ?></p>
        <p>Content: <?= $message['message'] ?></p>
        <hr>

    <?php endforeach; ?>


</main>



</body>
</html>
