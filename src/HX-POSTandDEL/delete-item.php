<?php 

session_start();


// Kuinka otetaan DELETE parametri vastaan?

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    // Vaihtoehto A
    // parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $queryParams);
    // echo "test". $queryParams['index'];

    // Vaihtoehto B
    if(isset($_GET['id'])){
        // Poistetaan taulukosta tietty indeksi
        $id = $_GET['id'];
        unset($_SESSION['items'][$id]);
    }else{
        echo "ei ole indeksi";
    }
}else{
    echo "ei ole DELETE metodi";
}

?>