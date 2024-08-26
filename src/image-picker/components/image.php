<?php

// functions here. generate HTML-components
    // $isAvailableImage on oletuksena true, mutta funktiota voi kutsua myös antamalla parametrille
    // jonkin toisen arvon
    function renderImage($image, $isAvailableImage = true){
        
        // Tarvitaan logiikka, joka generoi joko POST tai DELETE-elementtejä
        // 1. kuvan lisäys elementti
        // 2. kuvan poisto elementti

        // Elementit ovat muuten samanlaisia, mutta niillä on eri attribuutit

        // Data pitää pyörittää muuttujien kautta
        $title = $image['title'];
        $src = "images/" . $image['display']['src'];
        $alt = $image['display']['alt'];
        
        $id = $image['id'];

        // Lisätään tähän logiikka, joka määrittelee napin HTMX-attribuutit

        if($isAvailableImage){
            // Oletuksena TRUE, eli POST
            $attributes = "hx-post=\"select-image.php\"
                    hx-vals='{\"imageId\": \"$id\"}'
                    hx-target=\"#selected-images\"
                    hx-swap=\"beforeend\"";
        } else{
            // Poikkeuksena voi olla FALSE, eli DELETE
            $attributes = "
            hx-delete=\"select-image.php?id=$id\"
            hx-target=\"closest li\"
            hx-swap=\"outerHTML\"
            ";
        }

        // JSON objektin syntaksi {"avain": "arvo"}
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