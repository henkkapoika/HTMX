<?php
session_start();

if($_SERVER["REQUEST_METHOD"] === 'DELETE') {
    // Vaihtoehto A
    //parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $queryParams);
    //echo $queryParams['index']";

    // Vaihtoehto B
    if(isset($_GET['id'])){
        // Poistetaan taulukosta tietty id
        $id = $_GET['id'];
        unset($_SESSION['items'][$id]);
    } else{
        echo "ei ole id";
    }
} else {
    echo "ei ole DELETE-metodi";
}



?>