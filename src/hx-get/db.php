<?php
$data = "Lorem ipsum dolor sit amet consectetur adipisicing elit Voluptates culpa mollitia reprehenderit asperiores
Consequuntur quaerat aut iure deserunt Consequuntur veniam ullam repellendus
laboriosam magni suscipit ratione quod saepe dolore perspiciatis.";

$lines = explode("\n", $data);

echo "<ul>";

foreach ($lines as $line) {
    echo "<li>" . htmlspecialchars(trim($line)) . "</li>";
}

echo "</ul>";

?>