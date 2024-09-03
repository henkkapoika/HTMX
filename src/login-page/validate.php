<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['email']) && strpos($_POST['email'], '@') === false){
        echo "E-Mail address is invalid.";
    } elseif(isset($_POST['email']) && strpos($_POST['email'], '@') === true) {
        echo ""; // email ok
    } elseif(isset($_POST['password']) && strlen($_POST['password']) < 8){
        echo "Password must be at least 8-characters long";
    } elseif(isset($_POST['password']) && strlen($_POST['password']) >= 8){
        echo ""; // salasana ok
    } else{
        echo ""; // varana else - kaikki ok
    }
}

?>