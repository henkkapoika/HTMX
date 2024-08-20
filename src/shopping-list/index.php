<?php

include "funcs.php";

session_start();
//session_destroy();

// Tarkistetaan onko muuttuja olemassa
// Jotta ei tyhjennetä käytttäjän ostoslistaa
if(!isset($_SESSION['items'])){

    // Luodaan session-muuttuja, jossa oletuksena tyhjä taulukko
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
    <main>
        <h1>Shopping List</h1>
        <section id="forms">
            <form id="item-form" hx-post="functionality.php" hx-target="#items" hx-swap="beforeend" 
            hx-on::after-request="this.reset(); document.querySelector('input').focus();"
            hx-disabled-elt="form button">
                <div>
                    <label for="item">Item</label>
                    <input required type="text" id="item" name="item" />
                </div>
                <button type="submit">Add item</button>
            </form>
            <form hx-delete="clear-items.php"
            hx-target="#items"
            hx-swap="innerHTML"
            hx-confirm="Are you sure you want to clear all items?"
            hx-disabled-elt="#clear-all"
            >
                <button type="submit" id="clear-all">Clear all</button>
            </form>
        </section>
        <section>
            <ul id="items" hx-swap="outerHTML" hx-confirm="Are you sure?">
                 <?php
                    foreach($_SESSION['items'] as $id => $item){
                        echo listElement($id, $item);
                    }
                 ?>
            </ul>
        </section>
        </form>
    </main>
</body>
</html>