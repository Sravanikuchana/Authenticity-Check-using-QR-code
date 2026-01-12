<?php
$email = $_POST['Email'];
$pass1 = $_POST['Password'];
$uname = $_POST['Username'];

$servername = "sql110.infinityfree.com";
$username   = "if0_40080170";
$password   = "ISHUkuchana05";
$database   = "if0_40080170_details";

$con = new mysqli($servername, $username, $password, $database);

$sql = "INSERT INTO users (Email, Password, Username) VALUES ('$email', '$pass1', '$uname')";
$res = $con->query($sql);

if ($res)
    header("Location: login.html");
else
    echo("not reg");

$con->close();
?>
