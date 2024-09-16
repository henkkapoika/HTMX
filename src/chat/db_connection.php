<?php

$host = "mysql_db";
$username = "root";
$password = "root";
$dbname = "chat";

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}