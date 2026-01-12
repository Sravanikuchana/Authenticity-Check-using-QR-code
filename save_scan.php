<?php
session_start();

$db_host = "sql110.infinityfree.com";
$db_user = "if0_40080170";
$db_pass = "ISHUkuchana05";
$db_name = "if0_40080170_details";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

// Get scan data from GET
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "guest";
$qr_id = isset($_GET['data']) ? trim($_GET['data']) : '';
$brand = isset($_GET['brand']) ? trim($_GET['brand']) : '';
$status = isset($_GET['status']) ? trim($_GET['status']) : 'fake';

// Connect to database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    echo json_encode(["error" => "DB connection failed: " . $conn->connect_error]);
    exit;
}

// Create scan_history table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS scan_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    qr_id VARCHAR(255),
    brand VARCHAR(255),
    status ENUM('valid','fake'),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Insert scan record if qr_id provided
if ($qr_id !== '') {
    $stmt = $conn->prepare("INSERT INTO scan_history (email, qr_id, brand, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $qr_id, $brand, $status);
    $stmt->execute();
    $stmt->close();
}

// Fetch all scan history
$sql = "SELECT email, qr_id, brand, status, date FROM scan_history ORDER BY date DESC";
$result = $conn->query($sql);

$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

// Return JSON
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
