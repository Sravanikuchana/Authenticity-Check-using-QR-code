<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents("php://input");
    $messages = json_decode($json, true);
    file_put_contents("contact.json", json_encode($messages, JSON_PRETTY_PRINT));
}
?>
