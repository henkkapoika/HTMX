<?php
include "data/images.php";
include "components/image.php";
session_start();

if(!isset($_SESSION['selected-images'])){
    $_SESSION['selected-images'] = [];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Picker</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/htmx.org@2.0.1" integrity="sha384-QWGpdj554B4ETpJJC9z+ZHJcA/i59TyjxEPXiiUgN2WmTyV5OEZWCD6gQhgkdpB/" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="logo.png" alt="Camera logo">
        <h1>PhotoPicker</h1>
        <p>Pick a collection of photos from the selection</p>
    </header>
    <main>
        <section>
            <!-- Käyttäjän valinnat -->
            <h2>Selected Images</h2>
            <ul id="selected-images">
                <?php
                    foreach($_SESSION['selected-images'] as $image){
                        echo renderImage($image); // generoi li-elementin HTML-koodin
                    }
                ?>
            </ul>

        </section>
        <section>
            <!-- Kaikki kuvat -->
            <h2>Available images</h2>
            <ul>
                <?php
                    // Käydään läpi /data/images.php tiedoston muuttujan $DATABASE_IMAGES-taulukko
                    foreach($DATABASE_IMAGES as $image){
                        echo renderImage($image);
                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>