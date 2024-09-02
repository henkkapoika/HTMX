<?php
session_start();

include "data/images.php";
include "components/image.php";
include "funcs.php";

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $suggestedImages = getSuggestedImages($DATABASE_IMAGES);

    foreach($suggestedImages as $image){
        echo renderImage($image);
    }
}

?>