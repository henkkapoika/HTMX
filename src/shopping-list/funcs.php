<?php

// Lisätään funktio, joka generoi <li>-elementin
function listElement($id, $item) {
    
    // li-elementin id voidaan poistaa, kun käytetetään hx-target="closest li"
    $html = "<li>";
    $html .= "<span>$item</span>";
    $html .= "<button
                hx-delete=\"delete-item.php?id=$id\"
                hx-target=\"closest li\"
                >Remove</button>";
    $html .= "</li>";
    
    return $html;
}



?>