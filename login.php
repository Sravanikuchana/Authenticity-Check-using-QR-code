<?php
session_start(); // start session at the top

$Email = $_POST['Email'];
$pwd   = $_POST['Password'];

$servername = "sql110.infinityfree.com";
$username   = "if0_40080170";
$password   = "ISHUkuchana05";
$database   = "if0_40080170_details";

$con = new mysqli($servername, $username, $password, $database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Admin credentials hardcoded
$adminCredentials = [
    "ishukuchana@gmail.com" => "2005",
    
];

// Admin login
if (isset($adminCredentials[$Email]) && $pwd == $adminCredentials[$Email]) {
    $_SESSION['email'] = $Email;
    $_SESSION['role']  = "admin";
    header("Location: admin.html");
    exit();
}

// Normal user login
$sql = "SELECT Email, Password FROM users WHERE Email=? AND Password=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $Email, $pwd);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['email'] = $Email;
    $_SESSION['role']  = "user";
    header("Location: dashboard.html");
    exit();
} else {
    echo "Please enter valid email and password!";
}

$stmt->close();
$con->close();
?>
