<?php
session_start();

include 'data/images.php';
include 'components/image.php';
include 'funcs.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $recommendedImages = recommendedImages($DATABASE_IMAGES);

    foreach($recommendedImages as $image){
        echo renderImage($image);
    }
}



?>