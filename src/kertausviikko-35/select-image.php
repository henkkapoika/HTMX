<?php
session_start();
include "data/images.php";
include "components/image.php";
include 'funcs.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $imageId = $_POST['imageId'];

    $image = null;

    foreach($DATABASE_IMAGES as $img){
        if($img['id'] === $imageId){
            $image = $img;
            break;
        }
    }

    if($image){
        $_SESSION['selected-images'][] = $image;
    }

    echo renderImage($image, false);

    echo "<ul id=\"available-images\" hx-swap-oob=\"true\">";
                $selected = $_SESSION['selected-images'];
                $availableImages = array_filter($DATABASE_IMAGES, function($image) use ($selected){ 
                    return !in_array($image, $selected);
                });

                foreach($availableImages as $image){
                    echo renderImage($image);
                }
    echo "</ul>";

    $recommendedImages = recommendedImages();
    echo "<ul id=\"recommended-images\" hx-swap-oob=\"innerHTML\">";
                foreach($recommendedImages as $image){
                    echo renderImage($image);
                }
     echo  "</ul>";
    

}
if($_SERVER["REQUEST_METHOD"] === 'DELETE'){
    if(isset($_GET['id'])){
        $imageId = $_GET['id'];
        
        $imageIndex = null; 
        foreach ($_SESSION['selected-images'] as $index => $image) {
            if($imageId === $image['id']){
                $imageIndex = $index;
                break; 
            }
        }

        if($imageIndex !== null){
            array_splice($_SESSION['selected-images'], $imageIndex, 1);

            echo "<ul id=\"available-images\" hx-swap-oob=\"true\">";
                    $selected = $_SESSION['selected-images'];
                    $availableImages = array_filter($DATABASE_IMAGES, function($image) use ($selected){
                        return !in_array($image, $selected);
                    });

                    foreach($availableImages as $image){
                        echo renderImage($image);
                    }
            echo "</ul>";
        }
    }
}
?>