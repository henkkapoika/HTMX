<?php

// functions here. generate HTML-components
    function renderImage($image){
        
        // Data pitää pyörittää muuttujien kautta
        $title = $image['title'];
        $src = "images/" . $image['display']['src'];
        $alt = $image['display']['alt'];
        
        $id = $image['id'];

        // JSON objektin syntaksi {"avain": "arvo"}
        $html = "
            <li>
                <button
                    hx-post=\"select-image.php\"
                    hx-vals='{\"imageId\": \"$id\"}'
                    hx-target=\"#selected-images\"
                    hx-swap=\"beforeend\"
                >
                    <img src=\"$src\" alt=\"$alt\">
                    <h3>$title</h3>
                </button>
            </li>
        ";

        return $html;
    }
?>