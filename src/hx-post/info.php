<?php
// haetaan tietokannasta data
// leivotaan dataa
// generoidaan datasta html-koodia
// echo palauttaa html-koodin


// Siirretään data sessioon, jotta voidaan tallentaa siihen käyttäjän dataa.
if(!isset($_SESSION['notes'])){
    $_SESSION['notes'] = [
        "htmx extends and generalizes the core idea of HTML as a hypertext, opening up many more possibilities directly within the language",
        "Now any element, not just anchors and forms, can issue an HTTP request",
        "Now any event, not just clicks or form submissions, can trigger requests",
        "Now any HTTP verb, not just GET and POST, can be used",
        "Now any element, not just the entire window, can be the target for update by the request",
    ];
}


// luodaan html-koodi

echo "<ul>";

// tässä luodaan li-elementit, $lines-arrayn datasta (silmukalla)
foreach ($_SESSION['notes'] as $note) {
    // Silmukan sisällä laitetaan $line li-elementin sisälle.
    // trim poistaa välilyönnit alusta ja lopusta
    // htmlspecialchars estää XSS ja käsittelee sisällön tekstinä
    echo "<li>" . htmlspecialchars(trim($note)) . "</li>";
}

echo "</ul>";


?>