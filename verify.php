<?php
session_start();  // optional if you want to track user sessions

// Database credentials
$db_host = "sql110.infinityfree.com";
$db_user = "if0_40080170";
$db_pass = "ISHUkuchana05";
$db_name = "if0_40080170_details";

// Set JSON header
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

// Get QR code ID from GET parameter
$qrData = isset($_GET['data']) ? trim($_GET['data']) : '';
if ($qrData === '') {
    echo json_encode(["status"=>"fake","message"=>"No QR data provided"]);
    exit;
}

// Sanitize the QR code ID
$productId = preg_replace("/[^A-Za-z0-9_\-]/", "", $qrData);
if ($productId === '') {
    echo json_encode(["status"=>"fake","message"=>"Invalid QR code"]);
    exit;
}

// Connect to database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    echo json_encode(["status"=>"fake","message"=>"Database connection failed: " . $conn->connect_error]);
    exit;
}

// Query the qrcodes table
$stmt = $conn->prepare("SELECT id, name, brand, status, created_at FROM qrcodes WHERE id=? LIMIT 1");
$stmt->bind_param("s", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['status'] === 'active') {
        // QR code is valid
        echo json_encode([
            "status" => "valid",
            "id" => $row['id'],
            "name" => $row['name'],
            "brand" => $row['brand'],
            "created_at" => $row['created_at']
        ]);
    } else {
        // QR code revoked
        echo json_encode([
            "status" => "fake",
            "message" => "QR Code is revoked/inactive"
        ]);
    }
} else {
    // QR code not found
    echo json_encode(["status"=>"fake","message"=>"QR Code not found"]);
}

// Close connections
$stmt->close();
$conn->close();
?>
