<?php
include "data/images.php";
include "components/image.php";
session_start();
//session_destroy();

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
    <script src="main.js" defer></script>
</head>
<body>
    <header>
        <img src="logo.png" alt="Camera logo">
        <h1>PhotoPicker</h1>
        <p>Pick a collection of photos from the selection</p>
    </header>
    <main>
        <section id="selected-images-section">
            <!-- Käyttäjän valinnat -->
            <h2>Selected Images</h2>
            <ul id="selected-images">
                <?php
                    foreach($_SESSION['selected-images'] as $image){
                        echo renderImage($image, false); // generoi li-elementin HTML-koodin
                    }
                ?>
            </ul>

        </section>
        <section>
            <!-- Kaikki kuvat -->
            <h2>Available images</h2>
            <ul id="available-images">
                <?php
                    // Käydään läpi /data/images.php tiedoston muuttujan $DATABASE_IMAGES-taulukko

                    $selected = $_SESSION['selected-images'];
                    // Lisätään suodatus, joka ottaa pois kuvat jotka käyttäjä on jo valinnut
                    $availableImages = array_filter($DATABASE_IMAGES, function($image) use ($selected){ // anonyymi-funktio
                        // Tämä funktio on suodatin
                        return !in_array($image, $selected);
                        // tämän funktion pitää palauttaa joko TRUE tai FALSE
                    }); // array_filter ei muokkaa alkuperäistä taulukkoa, vaan palauttaa uuden version

                    foreach($availableImages as $image){
                        echo renderImage($image);
                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>