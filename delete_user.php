<?php
header("Content-Type: application/json");
require "db.php";

// Read JSON POST
$data = json_decode(file_get_contents("php://input"), true);
$email = isset($data['email']) ? $data['email'] : '';

if (empty($email)) {
    echo json_encode(["success" => false, "error" => "Email is required"]);
    exit;
}

// Delete user by email
$sql = "DELETE FROM users WHERE email = '$email'";

if ($con->query($sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $con->error]);
}

$con->close();
?>
