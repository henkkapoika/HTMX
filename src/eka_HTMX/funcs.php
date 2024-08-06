<?php

function generateList(){
    // haetaan tietokannasta data
    // leivotaan dataa
    // generoidaan datasta html-koodia
    // echo palauttaa html-koodin

    // "haetaan" tietokannasta
    $data = "htmx extends and generalizes the core idea of HTML as a hypertext, opening up many more possibilities directly within the language
    Now any element, not just anchors and forms, can issue an HTTP request
    Now any event, not just clicks or form submissions, can trigger requests
    Now any HTTP verb, not just GET and POST, can be used
    Now any element, not just the entire window, can be the target for update by the request";

    // Nyt $data:n sisällöstä halutaan generoida html-lista
    // jokaisen rivin lopussa on \n (rivinvaihto)

    // explode-funktio ottaa annetun string-datan ($data)
    // ja jakaa sen taulukkoon (array) annetun merkin ("\n") perusteella
    $lines = explode("\n", $data);

    // luodaan html-koodi
    echo "<ul>";

    // tässä luodaan li-elementit, $lines-arrayn datasta (silmukalla)
    foreach ($lines as $line) {
        // Silmukan sisällä laitetaan $line li-elementin sisälle.
        // trim poistaa välilyönnit alusta ja lopusta
        // htmlspecialchars estää XSS ja käsittelee sisällön tekstinä
        echo "<li>" . htmlspecialchars(trim($line)) . "</li>";
    }

    echo "</ul>"; // <- Added missing semicolon

    // generateList päättyy
} 
?>