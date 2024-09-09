<?php

// oikeassa tilanteessa ei tunnuksia koodiin (github)
$host = "mysql_db"; 
$db = "login_demo";
$user = "root";
$pass = "root";


$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


?>