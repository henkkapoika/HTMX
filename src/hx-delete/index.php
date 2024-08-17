<?php

session_start();

if(!isset($_SESSION['items'])){
    $_SESSION['items'] = [];
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/htmx.org@2.0.1" integrity="sha384-QWGpdj554B4ETpJJC9z+ZHJcA/i59TyjxEPXiiUgN2WmTyV5OEZWCD6gQhgkdpB/" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="logo.png"alt="">
        <h1>Portal</h1>
    </header>
    <main>
        <form hx-post="input.php" hx-target="ul" hx-swap="beforeend">
            <label for="">Add info:</label>
            <input type="text" id="item" name="item">
            <button>Submit</button>
        </form>
        <ul>
            <?php 
            foreach ($_SESSION["items"] as $key => $item) {
                echo "<li id='item-$key'>
                <span>" . htmlspecialchars($item) . "</span>
                <button 
                    hx-delete=\"delete.php?index=$key\"
                    hx-target=\"#item-$key\"
                    hx-swap=\"outerHTML\"
                    >Remove</button>
                </li>";
            }
            ?>
        </ul>
    </main>
</body>
</html>