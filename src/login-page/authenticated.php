<?php
session_start();

if(!isset($_SESSION["email"])){
    header("Location: index.php");
    exit();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/htmx.org@2.0.1" integrity="sha384-QWGpdj554B4ETpJJC9z+ZHJcA/i59TyjxEPXiiUgN2WmTyV5OEZWCD6gQhgkdpB/" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/htmx.org@1.9.12/dist/ext/response-targets.js"></script>
</head>
<body>
    <main>
        <h1>Authenticated!</h1>
    </main>

</body>
</html>