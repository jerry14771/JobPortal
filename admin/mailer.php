<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $result = $conn->query("SELECT * FROM admins LIMIT 1");
        $admin = $result->fetch_assoc();

        if ($admin && $admin['email'] === $email && password_verify($password, $admin['password'])) {
            $otp = rand(100000, 999999);
            $otpGeneratedTime = date('Y-m-d H:i:s');

            $stmt = $conn->prepare("UPDATE admins SET temp_otp = ?, otp_generated_time = ? WHERE id = ?");
            $stmt->bind_param("ssi", $otp, $otpGeneratedTime, $admin['id']);
            $stmt->execute();

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = $smtp_host;
                $mail->SMTPAuth = true;
                $mail->Username = $smtp_user; 
                $mail->Password = $smtp_pass;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = $smtp_port;

                $mail->setFrom($smtp_user, 'Pixel Apply');
                $mail->addAddress($smtp_admin_mail);

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP for Admin Login';
                $mail->Body = "Your OTP is: <b>$otp</b><br>Valid for 5 minutes.";
                $mail->send();
                header("Location: verify_otp.php");
                exit();
            } catch (Exception $e) {
                echo "Error sending email: {$mail->ErrorInfo}";
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Please fill out all fields.";
    }
}
?>
