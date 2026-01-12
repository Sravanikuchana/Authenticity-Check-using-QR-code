<?php
header("Content-Type: application/json");
require "db.php"; // make sure this has your $con connection

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

$email = isset($data['email']) ? trim($data['email']) : '';
$password = isset($data['password']) ? trim($data['password']) : '';
$confirm_password = isset($data['confirm_password']) ? trim($data['confirm_password']) : '';

if ($email === '' || $password === '' || $confirm_password === '') {
    echo json_encode(["success" => false, "error" => "Email and passwords are required"]);
    exit;
}

if ($password !== $confirm_password) {
    echo json_encode(["success" => false, "error" => "Password and Confirm Password do not match"]);
    exit;
}

// Update user using email as key
$sql = "UPDATE users SET Password=?, Confirm_password=? WHERE Email=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $password, $confirm_password, $email);

if ($stmt->execute()) {
    if($stmt->affected_rows > 0){
        echo json_encode(["success" => true, "message" => "Password updated successfully"]);
    } else {
        echo json_encode(["success" => false, "error" => "No user found with this email"]);
    }
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$con->close();
?>
