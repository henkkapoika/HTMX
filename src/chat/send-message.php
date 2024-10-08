<?php

session_start();

include 'templates/chat-bubbles.php';
include 'db_connection.php';

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["chat-input"])){
    $messageContent = $_POST["chat-input"];
    $timeNow = date("Y-m-d H:i:s");

    $userId = $_SESSION["user_id"];
    $chatId = $_SESSION["chat_id"];

    $stmt = $mysqli->prepare("INSERT INTO messages (chat_id, user_id, content, sent_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $chatId, $userId, $messageContent, $timeNow);

    if($stmt->execute()){
        // Toimii
        http_response_code(200);
        echo generateSentMessage($messageContent, $timeNow);
    }else{
        // Virhe
        http_response_code(500);
        echo "SQL-virhe";
    }

    $stmt->close();
}else{
    http_response_code(400);
    echo "Error";
}

$mysqli->close();

?>