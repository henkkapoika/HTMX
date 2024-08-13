<?php
session_start();

if($_SERVER["REQUEST_METHOD"] === 'DELETE') {
    // Vaihtoehto A
    //parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $queryParams);
    //echo $queryParams['index']";

    // Vaihtoehto B
    if(isset($_GET['index'])){
        // POistetaan taulukosta tietty indeksi
        $index = (int)$_GET['index'];
        unset($_SESSION['items'][$index]);
    } else{
        echo "ei ole indeksi";
    }
} else {
    echo "ei ole DELETE-metodi";
}


?>