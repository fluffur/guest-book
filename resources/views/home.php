<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            max-width: 800px;
            width: 100%;
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

    </style>

    <title>Home page</title>
</head>
<body>

<header>
    <h1>Guest book</h1>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
            <li><a href="/messages">Show messages</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Home page</h2>
</main>
</body>
</html>