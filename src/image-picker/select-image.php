<?php
session_start();
include "data/images.php";
include "components/image.php";
include "funcs.php";

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

    // 3. Palautetaan HTML, määritetään fuktioon false että kyseessä on DELETE-versio
    echo renderImage($image, false);

    // Lisätään OOB-ominaisuus, joka poistaa valitun kuvan alemmasta listasta
    echo "<ul id=\"available-images\" hx-swap-oob=\"true\">";
                $selected = $_SESSION['selected-images'];
                $availableImages = array_filter($DATABASE_IMAGES, function($image) use ($selected){ // anonyymi-funktio
                    return !in_array($image, $selected);
                });

                foreach($availableImages as $image){
                    echo renderImage($image);
                }
    echo "</ul>";

    // päivitetään suggested images section
    $suggestedImages = getSuggestedImages();
    echo "<ul id=\"suggested-images\" hx-swap-oob=\"innerHTML\">";
                foreach($suggestedImages as $image){
                    echo renderImage($image);
                }
     echo  "</ul>";

}

if($_SERVER["REQUEST_METHOD"] === 'DELETE'){
    if(isset($_GET['id'])){
        $imageId = $_GET['id'];
        
        // Etsitään taulukon indeksi, jossa on valitun kuvan id
        $imageIndex = null; // kuvan indeksi sessiossa
        foreach ($_SESSION['selected-images'] as $index => $image) {
            if($imageId === $image['id']){
                $imageIndex = $index;
                break; // Voidaan lopettaa silmukan suoritus, koska yksi ID on vain kerran sessiossa.
            }
        }

        // Poistetaan taulukosta elementti indeksin perusteella
        if($imageIndex !== null){
            array_splice($_SESSION['selected-images'], $imageIndex, 1);

            // Lisätään vastaukseen "out of bounds"-parametri/data
            // Joka on HTMX-tekniikka, jolla voidaan päivittää muita HTML-elementtejä
            echo "<ul id=\"available-images\" hx-swap-oob=\"true\">";
                    $selected = $_SESSION['selected-images'];
                    $availableImages = array_filter($DATABASE_IMAGES, function($image) use ($selected){ // anonyymi-funktio
                        return !in_array($image, $selected);
                    });

                    foreach($availableImages as $image){
                        echo renderImage($image);
                    }
            echo "</ul>";
        }
    }
    // Tämä tiedosto lähettää vastauksen ja vastauksen data määritellään esim echo-funktiolla
    // Jos ei määritetä echolla sisältöä, response.body on tyhjä
}

?>