<?php
$servername = "sql110.infinityfree.com";
$username   = "if0_40080170";
$password   = "ISHUkuchana05";
$database   = "if0_40080170_details";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die(json_encode([
        "success" => false,
        "error" => $con->connect_error
    ]));
}
?>
