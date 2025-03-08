<?php
session_start();
require 'ipHandler.php'; // Include your database configuration file

$tz = 'Asia/Kolkata';
date_default_timezone_set($tz);

// Function to get the client's IP address
function getClientIP() {
    return $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
}

$ip_address = getClientIP();

// Check if the user is still blocked in the database
$stmt = $conn->prepare("SELECT locked_until FROM login_attempts WHERE ip_address = ?");
$stmt->bind_param("s", $ip_address);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row || !$row['locked_until'] || strtotime($row['locked_until']) < time()) {
    // User is not blocked, redirect to login page
    header("Location: login.php");
    exit();
}

// Calculate remaining lockout time
$lockoutTime = strtotime($row['locked_until']);
$remainingTime = $lockoutTime - time();
if ($remainingTime < 0) {
    $remainingTime = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/images/favicon.ico">
<title>Pixel Apply - Attempts Exceed</title>

<title>Too Many Attempts</title>
<style>
    body {
        background-color: #f8d7da;
        color: #721c24;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .container {
        text-align: center;
        background-color: #f5c6cb;
        padding: 20px;
        border: 1px solid #f5c2c7;
        border-radius: 8px;
        max-width: 400px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        margin-bottom: 10px;
    }
    p {
        margin-bottom: 20px;
    }
    a {
        text-decoration: none;
        color: #721c24;
        font-weight: bold;
    }
    #back-link {
        display: none; /* Hide the link initially */
    }
</style>
</head>
<body>

<div class="container">
    <h1>Too Many Attempts</h1>
    <p>You have exceeded the maximum number of login attempts.</p>
    <p>Please try again in <span id="timer">...</span></p>
    <div id="back-link">
        <a href="login.php" id="backToLogin" style="display: none;">Back to Login</a>
    </div>
</div>

<script>
    // Pass remaining time from PHP to JavaScript
    const remainingTime = parseInt('<?php echo $remainingTime; ?>', 10);

    // Timer countdown
    let timeLeft = remainingTime > 0 ? remainingTime : 0;
    const timerElement = document.getElementById('timer');
    const backToLogin  = document.getElementById('backToLogin');

    const updateTimer = () => {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerElement.textContent = `${minutes}m ${seconds < 10 ? '0' : ''}${seconds}s`;

        if (timeLeft > 0) {
            timeLeft--;
        }
    };

    updateTimer();
    setInterval(updateTimer, 1000);
</script>

</body>
</html>