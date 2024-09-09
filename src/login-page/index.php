<?php

session_start();
//session_destroy();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://unpkg.com/htmx.org@2.0.1" integrity="sha384-QWGpdj554B4ETpJJC9z+ZHJcA/i59TyjxEPXiiUgN2WmTyV5OEZWCD6gQhgkdpB/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/htmx.org@1.9.12/dist/ext/response-targets.js"></script>
</head>
<body>
    <main>
        <form hx-post="login.php"
        hx-ext="response-targets"
        hx-headers='{"x-csrf-token": "43h534h53489fh34"}'
        hx-target-4*="#extra-information"
        hx-target-5*=".control"
        hx-sync="this:replace"
        >
            <img src="images/lock.jpg" alt="picture of pixel art padlock" hx-headers='{"x-csrf-token": "43h534h53489fh34"}'>
            <div class="control">
                <label for="email">Email</label>
                <input id="email" type="email" name="email"
                    hx-post="validate.php"
                    hx-target="next p"
                    hx-params="email"
                    hx-headers='{"x-csrf-token": "43h534h53489fh34"}'
                >
                <!-- simuloidaan CSRF-token -->
                <p class="error"></p>
            </div>
            <div class="control">
                <label for="password">Password</label>
                <input id="password" type="password" name="password"
                    hx-post="validate.php"
                    hx-target="next p"
                    hx-params="password"
                    hx-headers='{"x-csrf-token": "43h534h53489fh34"}'
                >
                <p class="error"></p>
            </div>
            <div id="extra-information"></div>
            <button type="submit">
                Login
            </button>
        </form>
    </main>
</body>
</html>