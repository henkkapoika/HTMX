<?php
session_start();
include 'templates/chat-bubbles.php';
include 'db_connection.php';

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

$i = 1;
while($i < 1){
    //echo "data: terve\n\n";
    
    // Tässä pitäisi olla event-driven architecture(EDA)
    // Joka lähettää jäyttäjän selaimelle uuden vastauksen vain, jos jotakin uutta on tapahtunut
    // EDA ei myöskään lukitse palvelimen suoritusta samalla tavalla kuin while(sleep(1));
    // Tällä hetkellä tämä toimii samalla tavalla kuin selaimen polling-ominaisuus

    // Tämä stream jatkuvasti tarkistaa tietokantaa ja palauttaa uuden viestin käyttäjälle

    $chat_id = $_SESSION["chat_id"];
    $user_id = $_SESSION["user_id"];
    $latest_id = $_SESSION["latest_id"];

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
        AND m.message_id > ?
        AND m.user_id != ?
        ORDER BY m.message_id ASC
    ';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("iio", $chat_id, $latest_id, $user_id);
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

    if(count($messages) > 0){
        $message = $messages[0];
        echo "data: " . generateReceivedMessage($message['username'], $message['content'],
        $message['parent_message_id'], $message['sent_at']) . "\n\n";
        flush();
    }

    $i++;
    sleep(1);
}

?>