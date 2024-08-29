<?php

// functions here. generate HTML-components
    function renderImage($image, $isAvailableimage = true){
        
        $title = $image['title'];
        $src = "images/" . $image['display']['src'];
        $alt = $image['display']['alt'];
        
        $id = $image['id'];

        // Määritellään joko POST tai DELETE
        if($isAvailableimage){
            $attributes = "hx-post=\"select-image.php\"
                        hx-vals='{\"imageId\": \"$id\"}'
                        hx-target=\"#selected-images\"
                        hx-swap=\"beforeend\"";
        } else {
            $attributes = "
                hx-delete=\"select-image.php?id=$id\"
                hx-target=\"closest li\"
                hx-swap=\"outerHTML\"
            ";
        }

        $html = "
            <li>
                <button
                    $attributes
                >
                    <img src=\"$src\" alt=\"$alt\">
                    <h3>$title</h3>
                </button>
            </li>
        ";

        return $html;
    }
?>