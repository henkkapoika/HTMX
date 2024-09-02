<?php

// Funktio palauttaa taulukossa kaksi vapaana olevaa kuvaa
function getSuggestedImages(){
    require "data/images.php";
    $selected = $_SESSION["selected-images"];

    $selected = $_SESSION['selected-images'];

        $availableImages = array_filter(
            $DATABASE_IMAGES, 
            function($image) use ($selected){
            return !in_array($image, $selected);
        
        }
    );

    // Määritellään indeksi uudestaan
    $availableImages = array_values($availableImages);

    // jos 2 tai alle kuvaa, palautetaan koko $availableImages
    // palautetaan 0, 1 tai 2 kuvaa taulukossa
    if(count($availableImages) <= 2){
        // palautetaan taulukko ja lopetetaan suoritus
        return $availableImages;
    }

    // Jos päästään tänne, kuvia oli yli 2 kpl

    // ["yksi", "kaksi", "kolme"] splice(1, 1)
    // return = ["kaksi"]
    // "kaksi"
    $suggestedImage1 = array_splice($availableImages, rand(0, count($availableImages) - 1), 1)[0];
    $suggestedImage2 = array_splice($availableImages, rand(0, count($availableImages) - 1), 1)[0];

    return [$suggestedImage1, $suggestedImage2];

}

?>