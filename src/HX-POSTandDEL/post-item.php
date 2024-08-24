<?php

session_start();

// Otetaan vastaan POST ja tallennetaan sessioon uusi item

// Onko POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Onko POST:n mukana 'item'
    if(isset($_POST['item'])){

        $id = uniqid();


        $_SESSION['items'][$id] = $_POST['item'];


        // Palautuksena riittää pelkkä uusin li-elementti
        echo "
        <li id='item-$id'>
            <span>" . htmlspecialchars($_POST['item']) . "</span>
            <button
            hx-delete=\"delete-item.php?id=$id\"
            hx-target=\"closest li\"
            hx-swap=\"outerHTML\"
            >Remove</button>
        </li>
        ";
    }
    else {
        echo "POST mukana puuttuu 'item' parametri";
    }
}
else {
    echo "ei ole POST metodi";
}

exit();
?>