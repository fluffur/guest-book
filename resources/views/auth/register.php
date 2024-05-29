<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>

    <style>
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
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
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

        main form input[type="text"],
        main form input[type="password"],
        main form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        main form input[type="submit"] {
            background-color: #333;
            color: white;
            cursor: pointer;
        }

        main form input[type="submit"]:hover {
            background-color: #555;
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
            <li>Register</li>
            <li><a href="/messages">Show messages</a></li>
        </ul>
    </nav>
</header>
<main>

    <h2>Register</h2>

    <form method="post" action="/register">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

        <label for="username">Username: </label>
        <input id="username" name="username" type="text" maxlength="255">
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" value="Register">
    </form>



</main>
</body>
</html>