<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "DELETE"){
    if(isset($_GET["key"])){
        $index = (int)$_GET['key'];
        unset($_SESSION['items'][$index]);
    }
}

?>