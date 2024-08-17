<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["item"])){
        $item = $_POST["item"];

        $_SESSION["items"][] = $item;

        $newIndex = count($_SESSION['items']) - 1;

        echo "<li id='item-$newIndex'>
                <span>" . htmlspecialchars($item) . "</span>
                <button 
                hx-delete=\"delete.php?index=$newIndex\"
                hx-target=\"#item-$newIndex\"
                hx-swap=\"outerHTML\"
                >Remove</button>
            </li>
            ";
    } else {
        echo "no item";
    }
} else {
    echo "no POST";
}

?>