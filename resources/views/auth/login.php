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
            <li>Login</li>
            <li><a href="/register">Register</a></li>
            <li><a href="/messages">Show messages</a></li>
        </ul>
    </nav>
</header>

<main>

    <h2>Log in</h2>
    <form method="post" action="/login">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
        <label for="username">Username: </label>
        <input id="username" name="username" type="text" maxlength="255">
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" value="Log in">
    </form>

</main>
</body>
</html>
