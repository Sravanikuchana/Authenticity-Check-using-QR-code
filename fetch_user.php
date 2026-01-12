<?php
include 'db.php';

if ($con->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$sql = "SELECT Username, Email, Password, Confirm_password FROM users";
$result = $con->query($sql);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = [
            'username' => $row['Username'],
            'email' => $row['Email'],
            'password' => $row['Password'], // Plain-text password
            'Confirm_password' => $row['Confirm_password']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($users);
$con->close();
?>
