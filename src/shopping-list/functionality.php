<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(isset($_POST["item"])){
        $userItem = $_POST['item'];

        $_SESSION["items"][] = $userItem;
        //header("Location: index.php");

        // Saadaan uusimman elementin indeksi selville
        // Tarkistamalla talukon pituus esim 5
        // Jos pituus on 5, indeksit ovat 0, 1, 2, 3, 4
        // Joten uusin indeksi on pituus - 1

        $newIndex = count($_SESSION['items']) - 1;

        echo "<li id='item-$newIndex'>
                <span>" . htmlspecialchars($userItem) . "</span>
                <button 
                hx-delete=\"delete-item.php?index=$newIndex\"
                hx-target=\"#item-$newIndex\"
                hx-swap=\"outerHTML\"
                >Remove</button>
            </li>
            ";
    } else {
        echo "Item not set";
    }
} else {
    echo "Not POST";
}

exit();
?>