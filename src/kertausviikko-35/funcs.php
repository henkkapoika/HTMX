<?php

function recommendedImages() {
    require 'data/images.php';
    $selected = $_SESSION['selected-images'];

        $availableImages = array_filter($DATABASE_IMAGES, function($image) use ($selected){
            return !in_array($image, $selected);
    
        }


    ); 

    $availableImages = array_values($availableImages);

    if(count($availableImages) <= 2){
        return $availableImages;
    }

    $suggestedImage1 = array_splice($availableImages, rand(0, count($availableImages) - 1), 1)[0];
    $suggestedImage2 = array_splice($availableImages, rand(0, count($availableImages) - 1), 1)[0];

    return [$suggestedImage1, $suggestedImage2];
}

?>