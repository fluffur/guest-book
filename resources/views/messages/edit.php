<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>

    <style>

        /* General */
        html {
            box-sizing: border-box;

        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        body {
            font-family: Inter, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1em 0;
            text-align: center;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            max-width: 800px;
            margin: 0 auto;
            flex-wrap: wrap;
            justify-content: center;
        }

        nav ul li a {
            display: block;
            color: white;
            padding: 30px;
            text-decoration: none;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            margin: 20px auto;
            padding: 20px;

            max-width: 600px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        main h2 {
            text-align: center;
            color: #333;
        }

        main form {
            margin-top: 20px;
        }

        main form label {
            display: block;
            margin-bottom: 5px;
        }

        main form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none;
        }

        main form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
            cursor: pointer;
        }

        main form input[type="submit"]:hover {
            background-color: #555;
        }

        main p {
            margin-bottom: 10px;
        }

        a {
            color: darkred;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        main hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ccc;
        }

        .messages {
            max-width: 600px;
            margin: 0 auto;
        }

        .message {
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 30px;
        }
    </style>

</head>
<body>
<header>
    <h1>Guest book</h1>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
            <li><a href="/messages">Messages</a></li>
        </ul>
    </nav>
</header>
<main>

    <?php if (isset($user['id']) && $user['id'] === $message['user_id']): ?>

        <form method="post" action="/messages/edit">
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="id" value="<?= $message['message_id'] ?>">
            <label for="message">Edit Message: </label>
            <br>
            <textarea
                name="message"
                id="message"
                cols="30"
                rows="2"
                maxlength="120"
                placeholder="Write your message here"><?= $message['message'] ?></textarea>
            <input type="submit" value="Enter message">
        </form>

    <?php else: ?>

        <p>To edit a message you must be <a href="/login">logged in</a>.</p>


    <?php endif; ?>



</main>

</body>
</html>
