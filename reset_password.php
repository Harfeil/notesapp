<?php

session_start();

require_once('db_connector.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $token){

    $mail = new PHPMailer(true); // Enable verbose debug output

    try {
        // Server settings
        $mail->isSMTP();                                         // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                // Enable SMTP authentication
        $mail->Username   = 'harfeilsalmeron1@gmail.com';              // SMTP username
        $mail->Password   = '';     // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption
        $mail->Port       = 587;                                // TCP port to connect to (587 for TLS)

        // Recipients
        $mail->setFrom('harfeilsalmeron1@gmail.com', 'Harfeil');
        $mail->addAddress($get_email, $get_name);               // Add a recipient

        // Content
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject = 'Password Reset';
        $mail->Body    = "
            <h2>Hello, $get_name</h2>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p><a href='forgot_password.php?token=$token&email=$get_email'>Click here to reset your password</a></p>
        ";

        $mail->send();
        echo 'Email sent successfully';
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if(isset($_POST["submit_password_btn"])){
    $email = $_POST["email"];
    $token = md5(rand());

    $email_check = "SELECT * FROM users WHERE user_email = '$email' LIMIT 1";
    $check_email_run = mysqli_query($connection, $email_check);

    if(mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($check_email_run);
        $get_email = $row["user_email"];
        $get_name = $row["user_fname"];

        $date = date("Y-m-d H:i:s");
        $update_token = "UPDATE users SET token = '$token', token_created = '$date' WHERE user_email = '$get_email' LIMIT 1";
        $update_token_run = mysqli_query($connection, $update_token);

        if($update_token_run){
            send_password_reset($get_name, $get_email, $token);
            $_SESSION["status"] = "We have emailed you a password reset link.";
            header("Location: forgot_password.php");
            exit(0);
        } else {
            $_SESSION["status"] = "Error updating token in the database.";
            header("Location: forgot_password.php");
            exit(0);
        }
    } else {
        $_SESSION["status"] = "Email not found in our records.";
        header("Location: forgot_password.php");
        exit(0);
    }
} else {
    $_SESSION["status"] = "No email provided.";
    header("Location: forgot_password.php");
    exit(0);
}
?>