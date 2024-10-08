<?php

function generateSentMessage($content, $sentAt, $username = null, $parentMessageId = null){
    ?>
    <!-- HTML-koodi -->
     <div class="message sent-container">
        <div class="message-content message-sent">
            <p class="text">
                <?= htmlspecialchars($content) ?>
            </p>
            <div class="message-footer">
                <p class="reply">Reply</p>
                <p class="time">
                    <?= htmlspecialchars(date('H:i', strtotime($sentAt))) ?>
                </p>
            </div>
        </div>
     </div>
    <?php
}

function generateReceivedMessage($username, $content, $parentMessageId, $sentAt){
    ?>
    <!-- HTML-koodi -->
     <div class="message">
        <div class="icon">
            <h2>
            <?= htmlspecialchars(strtoupper($username[0])) ?>
            </h2>
        </div>
        <div class="message-content message-received">
            <p class="text">
                <?= htmlspecialchars($content) ?>
            </p>
            <div class="message-footer">
                <p class="reply">Reply</p>
                <p class="time">
                    <?= htmlspecialchars(date('H:i', strtotime($sentAt))) ?>
                </p>
            </div>
        </div>
     </div>
    <?php
}

?>