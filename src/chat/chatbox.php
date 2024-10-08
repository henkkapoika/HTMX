<?php
// Viittaus funktiohin
include "templates/chat-bubbles.php";
include "db_connection.php";

// Kovakoodataan kirjautunut käyttäjä ja valittu chat
// Nämä viittaa tietokannan Id sarakkeeseen
$_SESSION["user_id"] = 1;
$_SESSION["chat_id"] = 1;
$_SESSION["latest_id"] = 0;

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

// $query2 = '
//     SELECT
//         chat_name
//     FROM chats
// ';

// $stmt2 = $mysqli->prepare($query2);
// $stmt2->execute();
// $result2 = $stmt2->get_result();

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
            <button onclick="toggleChatbox()"><img src="" alt="X"></button>
        </div>
    </header>
    <main>
        <!-- Generoidaan tietokannasta viestit HTML-muotoon -->
        <?php foreach($messages as $message): ?>
            <?php
                $_SESSION["latest_id"] = $message["message_id"];
                // Käyttäjän omat viestit
                if($message['user_id'] === $user_id){
                    generateSentMessage($message['content'], $message['sent_at'],
                     $message['username'], $message['parent_message_id']);
                }else{
                    // Muiden viestit
                    generateReceivedMessage($message['username'], $message['content'],
                     $message['parent_message_id'], $message['sent_at']);
                }
            ?>
        <?php endforeach; ?>

            <!-- sse-connect="stream.php" -->
        <div hx-ext="sse" sse-connect="http://localhost:3001/stream" sse-swap="message" hx-swap="beforeend">
            <!-- Tänne tulevat kaikkien muiden uudet viestit -->
        </div>
            <!-- Käyttäjän omat viestit -->
        <div class="reply-message-goes-here"></div>
    </main>
    <footer>
        <div>
            <form 
                hx-post="send-message.php"
                hx-swap="beforebegin show:.reply-message-goes-here:top"
                hx-target=".reply-message-goes-here"
                hx-on::after-request="this.reset(); document.querySelector('input').focus();"
            >
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