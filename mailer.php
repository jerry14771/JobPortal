<?php
require 'vendor/autoload.php';
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : null;
    $email = trim($_POST['email'])??'';
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $otp = isset($_POST['otp']) ? trim($_POST['otp']) : null;

    if (!empty($otp)) {
        verifyOTP($otp);
    } else {
        signUp($user_name, $email, $password);
    }
}

function signUp($user_name, $email, $password)
{
    global $conn;

    if (empty($user_name) || empty($email) || empty($password)) {
        echo "All fields are required.";
        return;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingUser = $result->fetch_assoc();

    if ($existingUser) {
        if ($existingUser['isVerified'] == "0") {
            $otpGeneratedTime = strtotime($existingUser['otp_generated_time']);
            $currentTime = time();
            $timeDifference = ($currentTime - $otpGeneratedTime) / 60; // Convert to minutes

            if ($timeDifference > 5) {
                $otp = rand(100000, 999999);
                $otpGeneratedTime = date('Y-m-d H:i:s');

                $stmt = $conn->prepare("UPDATE users SET temp_otp = ?, otp_generated_time = ? WHERE email = ?");
                $stmt->bind_param("sss", $otp, $otpGeneratedTime, $email);
                $stmt->execute();

                sendOTP($email, $otp);
                include "verify_otp.php";
            } else {
                echo "You have already signed up but not verified. Please check your email.";
            }
        } else {
            echo "Email already registered.";
        }
        return;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $otp = rand(100000, 999999);
    $otpGeneratedTime = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO users (user_name, email, `password`, temp_otp, otp_generated_time, isVerified) VALUES (?, ?, ?, ?, ?, '0')");
    $stmt->bind_param("sssss", $user_name, $email, $hashedPassword, $otp, $otpGeneratedTime);

    if ($stmt->execute()) {
        sendOTP($email, $otp);
        $_SESSION['temp_email'] = $email;
        header("location:verify_otp.php");
    } else {
        echo "Error registering user.";
    }
}

function verifyOTP($otp)
{
    global $conn;
    $email = $_SESSION['temp_email'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "Email not found. Please sign up first.";
        return;
    }

    if ($user['isVerified'] == 1) {
        echo "Your account is already verified.";
        return;
    }

    // Check if OTP is correct and within time limit
    $otpGeneratedTime = strtotime($user['otp_generated_time']);
    $currentTime = time();
    $timeDifference = ($currentTime - $otpGeneratedTime) / 60; // Convert to minutes

    if ($timeDifference > 5) {
        echo "OTP expired. Please request a new one.";
        return;
    }

    if ($user['temp_otp'] == $otp) {
        $stmt = $conn->prepare("UPDATE users SET isVerified = 1, temp_otp = NULL, otp_generated_time = NULL WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $_SESSION['temp_email'];
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid OTP. Please try again.";
    }
}

// Function to send OTP via email
function sendOTP($email, $otp)
{
    global $smtp_host, $smtp_user, $smtp_pass, $smtp_port;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_user;
        $mail->Password = $smtp_pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $smtp_port;

        $mail->setFrom($smtp_user, 'Pixelapply');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Signup';
        $mail->Body = "Your OTP is: <b>$otp</b><br>Valid for 5 minutes.";

        $mail->send();
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
}
?>