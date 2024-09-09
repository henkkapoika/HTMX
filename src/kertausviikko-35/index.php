<?php

include "data/images.php";
include "components/image.php"; 
include 'funcs.php';

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
    <title>Document</title>
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
        <section id="recommended-images-section">
            <h2>Recommended images</h2>
            <ul id="recommended-images"
            hx-get="recommended-images.php"
            hx-swap="innerHTML"
            hx-trigger="every 5s"
            >
                <?php
                    $recommendedImages = recommendedImages();
                    foreach($recommendedImages as $image){
                        echo renderImage($image);
                    }
                ?>
            </ul>
            <div id='loading'></div>
        </section>
        <section id="selected-images-section">
            <h2>Selected Images</h2>
            <ul id="selected-images"
            >
                <?php
                    foreach($_SESSION['selected-images'] as $image){
                        echo renderImage($image, false); 
                    }
                ?>
            </ul>

        </section>
        <section>
            <!-- Kaikki kuvat -->
            <h2>Available images</h2>
            <ul id="available-images">
                <?php
                    $selected = $_SESSION['selected-images'];

                    $availableImages = array_filter($DATABASE_IMAGES, function($image) use ($selected){
                        return !in_array($image, $selected);
                    }); 

                    foreach($availableImages as $image){
                        echo renderImage($image);
                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>