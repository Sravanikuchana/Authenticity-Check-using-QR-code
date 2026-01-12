<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = htmlspecialchars(trim($_POST['Name'] ?? ''));
    $email   = filter_var(trim($_POST['Email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['Message'] ?? ''));

    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('⚠️ All fields are required.'); window.history.back();</script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kuchanasravani01@gmail.com';
        $mail->Password   = 'YOUR_APP_PASSWORD';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('kuchanasravani01@gmail.com', 'AI Authenticity');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('kuchanasravani01@gmail.com');
        $mail->addAddress('balakathulamanisha@gmail.com');

        // Email content
        $mail->isHTML(false);
        $mail->Subject = "📩 New Contact Form Submission";
        $mail->Body    = "👤 Name: $name\n✉️ Email: $email\n\n💬 Message:\n$message";

        $mail->send();
        echo "<script>alert('✅ Your message has been sent successfully!'); window.location='contact.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('❌ Message could not be sent. Please try again later.'); window.history.back();</script>";
    }
} else {
    header("Location: contact.html");
    exit;
}
?>
