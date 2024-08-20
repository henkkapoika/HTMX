<?php
include "data/images.php";
include "components/image.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Käyttäjän valitseman kuvan id
    $imageId = $_POST['imageId'];

    // 1. Haetaan kuvan tiedot ID:n perusteella
    $image = null;
    // Jos tietokanta olisi käytössä, tässä haetaan ID:n perusteella
    foreach($DATABASE_IMAGES as $img){
        if($img['id'] === $imageId){
            $image = $img;
            break;
        }
    }

    // 2. Lisätään kuvan data sessioon 'selected-images'
    if($image){
        $_SESSION['selected-images'][] = $image;
    }

    // 3. Palautetaan HTML
    echo renderImage($image);
}

?>