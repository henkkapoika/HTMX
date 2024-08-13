<?php
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
        <section>
            <form id="item-form" hx-post="functionality.php" hx-target="#items" hx-swap="beforeend">
                <div>
                    <label for="item">Item</label>
                    <input type="text" id="item" name="item" />
                </div>
                <button type="submit">Add item</button>
            </form>
        </section>
        <section>
            <ul id="items">
                 <?php
                    foreach($_SESSION['items'] as $index => $item){
                        echo 
                        "<li id='item-$index'>
                            <span>" . htmlspecialchars($item) . "</span>
                            <button 
                            hx-delete=\"delete-item.php?index=$index\"
                            hx-target=\"#item-$index\"
                            hx-swap=\"outerHTML\"
                            >Remove</button>
                        </li>
                        ";
                    }
                 ?>
            </ul>
        </section>
        </form>
    </main>
</body>
</html>