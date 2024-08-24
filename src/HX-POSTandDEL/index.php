<?php

    session_start();
    // session_destroy();

    // Tarkistetaan onko muuttuja olemassa valmiina
    // Jotta ei tyhjennetä käyttäjän ostoslistaa
    if(isset($_SESSION['items']) === false){

        // Luodaan session muuttuja, jossa oletuksena tyhjä taulukko
        $_SESSION['items'] = [];
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="htmx.js"></script>
    <script src="https://unpkg.com/htmx.org@2.0.2" integrity="sha384-Y7hw+L/jvKeWIRRkqWYfPcvVxHzVzn5REgzbawhxAuQGwX1XWe70vji+VSeHOThJ" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <h1>Shopping List</h1>
        <section id="forms">
            <form id="item-form" 
            hx-post="post-item.php"
            hx-target="#items"
            hx-swap="beforeend"
            hx-on::after-request="this.reset();
            document.querySelector('input').focus();"
            hx-disabled-elt="form button"
            >
                <div>
                    <label for="item">Item</label>
                    <input type="text" required id="item" name="item" />
                </div>
                <button type="submit">Add item</button>
            </form>
            <form
            hx-delete="clear-items.php"
            hx-target="#items"
            hx-swap="innerHTML"
            hx-confirm="Are you sure you want to clear all items?"
            hx-disabled-elt="#clear-all"
            >
                <button type='submit' id='clear-all'>Clear All</button>
            </form>
        </section>
        <section>
            <ul id="items">
                <?php 
                    foreach($_SESSION['items'] as $id => $item){

                        // [
                        //      0 => "Maito"
                        //      1 => "Leipä"
                        //      2 => "Juusto"
                        // ]

                        echo
                        "
                        <li id='item-$id'>
                            <span>" . htmlspecialchars($item) . "</span>
                            <button
                            hx-delete=\"delete-item.php?id=$id\"
                            hx-target=\"closest li\"
                            hx-swap=\"outerHTML\"
                            >Remove</button>
                        </li>
                        ";
                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>