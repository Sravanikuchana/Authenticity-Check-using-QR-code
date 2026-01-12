<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        "name" => $_POST['Name'],
        "email" => $_POST['Email'],
        "message" => $_POST['Message'],
        "time" => date("Y-m-d H:i:s")
    ];

    $file = "contact.json";
    $messages = [];
    if (file_exists($file)) {
        $messages = json_decode(file_get_contents($file), true);
    }
    $messages[] = $data;
    file_put_contents($file, json_encode($messages, JSON_PRETTY_PRINT));

    echo "success";
}
?>
