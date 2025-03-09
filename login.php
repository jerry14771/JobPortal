<?php
require 'ipHandler.php';
if(isset($_SESSION['email'])){
    header('location:index.php');
}

$login_url = $client->createAuthUrl();

$maxAttempts = 5;
$lockoutTime = 300;
$tz = 'Asia/Kolkata';
date_default_timezone_set($tz);
function getClientIP()
{
    return $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
}

$ip_address = getClientIP();
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$error_message = '';

// Check if the user is already locked out
$stmt = $conn->prepare("SELECT locked_until FROM login_attempts WHERE ip_address = ?");
$stmt->bind_param("s", $ip_address);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && $row['locked_until'] && strtotime($row['locked_until']) > time()) {
    header("Location: too_many_attempts.php");
    exit();
}

// Process login attempt only if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user exists and the password is correct
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Successful login, reset attempts by IP
        $stmt = $conn->prepare("UPDATE login_attempts SET attempts = 0, locked_until = NULL WHERE ip_address = ?");
        $stmt->bind_param("s", $ip_address);
        $stmt->execute();
        $_SESSION['email'] = $email;
        header("location:index.php");
    } else {
        $stmt = $conn->prepare("SELECT attempts FROM login_attempts WHERE ip_address = ? and DATE(last_attempt) = DATE(now())");
        $stmt->bind_param("s", $ip_address);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $attempts = $row['attempts'] + 1;
            $stmt = $conn->prepare("UPDATE login_attempts SET attempts = ?, last_attempt = CURRENT_TIMESTAMP WHERE ip_address = ?");
            $stmt->bind_param("is", $attempts, $ip_address);
            $stmt->execute();
        } else {
            $attempts = 1;
            $stmt = $conn->prepare("INSERT INTO login_attempts (ip_address, attempts, last_attempt) VALUES (?, ?, CURRENT_TIMESTAMP)");
            $stmt->bind_param("si", $ip_address, $attempts);
            $stmt->execute();
        }

        // Check if the user should be locked out
        if ($attempts >= $maxAttempts) {
            $lockoutUntil = date('Y-m-d H:i:s', time() + $lockoutTime);
            $stmt = $conn->prepare("UPDATE login_attempts SET locked_until = ? WHERE ip_address = ?");
            $stmt->bind_param("ss", $lockoutUntil, $ip_address);
            $stmt->execute();
            header("Location: too_many_attempts.php");
            exit();
        } else {
            $error_message = "Incorrect login. Attempts left: " . ($maxAttempts - $attempts);
        }
    }
}

$stmt->close();
$conn->close();
?>







<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Pixel Apply - Find Your Dream Job</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Find the latest IT jobs and apply directly. No signup required!" name="description">
    <meta content="Job, CV, Career, Resume, Job Portal, Freshers Job, IT Jobs, Experienced Jobs, High Paying It Jobs" name="keywords">
    <meta name="version" content="1.6.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet">
    <link href="assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/tailwind.min.css" rel="stylesheet" type="text/css">
</head>

<body class="dark:bg-slate-900">
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <section
        class="h-screen flex items-center justify-center relative overflow-hidden bg-[url('../../assets/images/hero/bg3.html')] bg-no-repeat bg-center bg-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-900"></div>
        <div class="container">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1">
                <div
                    class="relative overflow-hidden bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                    <div class="p-6">
                        <a href="#">
                            <img src="assets/logo/Pixel_Apply_new.png" class="mx-auto h-[48px] block dark:hidden"
                                alt="">
                        </a>
                        <div style="display: flex; justify-content: space-between;align-items: center;">

                            <h5 class="my-6 text-xl font-semibold">Login</h5>

                            <?php if ($error_message): ?>
                                <div class="my-6 text-sm"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                        </div>

                        <form class="text-start" method="POST">
                            <div class="grid grid-cols-1">
                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="LoginEmail">Email Address:</label>
                                    <input id="LoginEmail" name="email" type="email" class="form-input mt-3 rounded-md"
                                        placeholder="name@example.com">
                                </div>

                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="LoginPassword">Password:</label>
                                    <input id="LoginPassword" name="password" type="password"
                                        class="form-input mt-3 rounded-md" placeholder="Password:">
                                </div>

                                <!-- Display error message for invalid login attempts -->


                                <div class="flex justify-between mb-4">
                                    <div class="inline-flex items-center mb-0">
                                        <input
                                            class="form-checkbox rounded size-4 appearance-none rounded border border-gray-200 dark:border-gray-800 accent-green-600 checked:appearance-auto dark:accent-green-600 focus:border-green-300 focus:ring-0 focus:ring-offset-0 focus:ring-green-200 focus:ring-opacity-50 me-2"
                                            type="checkbox" value="" id="RememberMe">
                                        <label class="form-checkbox-label text-slate-400" for="RememberMe">Remember
                                            me</label>
                                    </div>
                                    <p class="text-slate-400 mb-0"><a href="reset-password.html"
                                            class="text-slate-400">Forgot password ?</a></p>
                                </div>

                                <div class="mb-4">
                                    <input type="submit"
                                        class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-md w-full"
                                        value="Login">
                                </div>

                                <div class="mb-4">
                                    <a href="<?= htmlspecialchars($login_url) ?>"
                                        class="py-1 px-5 flex items-center justify-center font-semibold tracking-wide border transition duration-300 ease-in-out text-base bg-white hover:bg-gray-100 border-gray-300 text-gray-700 rounded-md w-full shadow-sm" style="display: flex; gap: 25px;">
                                       <div> <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png"
                                            alt="Google Logo" class="w-5 h-5 mr-3"></div>
                                            <div>
                                        Sign in using Google</div>
                                    </a>
                                </div>


                                <div class="text-center">
                                    <span class="text-slate-400 me-2">Don't have an account ?</span> <a
                                        href="signup.html" class="text-slate-900 dark:text-white font-bold">Sign Up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/plugins.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>