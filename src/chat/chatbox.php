<?php

// Viittaus funktiohin
include "templates/chat-bubbles.php";
include "db_connection.php";

// Kovakoodataan kirjautunut käyttäjä ja valittu chat
// Nämä viittaa tietokannan Id sarakkeeseen
$_SESSION["user_id"] = 1;
$_SESSION["chat_id"] = 1;

// Jostakin syystä tarvitaan id erillisessä muuttujassa
// $_SESSION ei toiminut
$chat_id = $_SESSION["chat_id"];
$user_id = $_SESSION["user_id"];

$query = '
    SELECT
        m.message_id,
        m.content,
        m.user_id,
        u.username,
        m.parent_message_id,
        m.sent_at
    FROM messages m
    JOIN users u ON m.user_id = u.user_id
    WHERE m.chat_id = ?
    ORDER BY m.message_id ASC
';

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $chat_id);
$stmt->execute();
$result = $stmt->get_result();

if(!$result){
    die("Query failed!: " . $mysqli->error);
}

// Tietokannan haku
$messages = [];
while($row = $result->fetch_assoc()){
    // Siirretään data taulukkoon
    $messages[] = $row;
}

$mysqli->close();


?>

<div id="chat" class="chatbox">
    <header class="chat-header">
        <h2>Chat</h2>
        <div class="buttons">
            <button><img src="" alt="_"></button>
            <button onclick="closeChatbox()"><img src="" alt="X"></button>
        </div>
    </header>
    <main>
        <!-- Generoidaan tietokannasta viestit HTML-muotoon -->
        <?php foreach($messages as $message): ?>
            <?php
                // Käyttäjän omat viestit
                if($message['user_id'] === $user_id){
                    generateSentMessage($message['username'], $message['content'],
                     $message['parent_message_id'], $message['sent_at']);
                }else{
                    // Muiden viestit
                    generateReceivedMessage($message['username'], $message['content'],
                     $message['parent_message_id'], $message['sent_at']);
                }
            ?>
        <?php endforeach; ?>
        <div class="reply-message-goes-here"></div>
    </main>
    <footer>
        <div>
            <form>
                <textarea name="chat-input" required></textarea>
                <button>
                    <div id="svg-wrapper">
                        <img src="arrow-icon.svg" alt="Arrow Icon">
                    </div>
                </button>
            </form>
        </div>
    </footer>
</div>

<button id="show" class="toggle-button" onclick="toggleChatbox()">Open Chat</button>