<?php
session_start();
include "funcs.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(isset($_POST["item"])){
        $userItem = $_POST['item'];

        $id = uniqid(); // Korvataan index käyttämällä uniikkia ID:tä

        // Tallennus SESSIOON
        $_SESSION["items"][$id] = $userItem;
        //header("Location: index.php");

        // Saadaan uusimman elementin indeksi selville
        // Tarkistamalla talukon pituus esim 5
        // Jos pituus on 5, indeksit ovat 0, 1, 2, 3, 4
        // Joten uusin indeksi on pituus - 1

        //$newIndex = count($_SESSION['items']) - 1;

        echo listElement($id, $userItem);
    } else {
        echo "Item not set";
    }
} else {
    echo "Not POST";
}

exit();
?>