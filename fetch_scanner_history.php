<?php
session_start(); // make sure session is started

$db_host = "sql110.infinityfree.com";
$db_user = "if0_40080170";
$db_pass = "ISHUkuchana05";
$db_name = "if0_40080170_details";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

// Connect to database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    echo json_encode(["error" => "DB connection failed: " . $conn->connect_error]);
    exit;
}

// ✅ Get the logged-in user's email from session
if (!isset($_SESSION['email'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$email = $_SESSION['email'];

// ✅ Fetch only this user's scan history
$stmt = $conn->prepare("SELECT email, qr_id, brand, status, date FROM scan_history WHERE email = ? ORDER BY date DESC");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

// ✅ Return JSON
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
