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
            <li><a href="/messages">Messages</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Home page</h2>
    <div id="disqus_thread"></div>
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
            const d = document, s = d.createElement('script');
            s.src = '<?= $_ENV['DISQUS_EMBED_URL']?>';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</main>
</body>
</html>