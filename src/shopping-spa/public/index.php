<?php

//require_once "../data/products.php";
require_once "../data/db-conn.php";

// Yksinkertainen routing
// shopping-spa?page=product&id=p3 => /shopping-spa/product/p3
$page = $_GET['page'] ?? 'home';

// Jokainen yhteys tulee tätä kautta
// Tässä voidaan suorittaa koodia, jota tarvitaan joka sivulla "middleware"

switch($page){
    case "product":
        require "../routes/product.php";
        break;
    case "cart":
        require "../routes/cart.php";
        break;
    default:
        require "../routes/home.php";
}

?>