<?php
header("Content-Type: application/json");
require "db.php";

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'];
$email = $data['email'];
$password = $data['password'];
$confirm_password = $data['confirm_password'];

// Check password confirmation
if ($password !== $confirm_password) {
    echo json_encode(["success" => false, "error" => "Passwords do not match"]);
    exit();
}

// Save password as plain text (not hashed)
$plainPassword = $password;

// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $plainPassword);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$con->close();
?>
