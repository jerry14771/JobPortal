<?php
require 'mailer.php';

?>

<html lang="en" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Pixel Apply - Find Your Dream Job</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Job Listing Landing" name="description">
    <meta content="Job, CV, Career, Resume, Job Portal, Create Job, Post job, tailwind Css" name="keywords">
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
                            <h5 class="my-6 text-xl font-semibold">Enter OTP</h5>
                            <?php if (isset($error)): ?>
                            <p class="text-red-500 text-center" style="color:red"><?= htmlspecialchars($error) ?></p>
                        <?php endif; ?>
                        </div>
                        <form method="POST" class="text-start">
                            <div class="grid grid-cols-1">
                                <div class="mb-4 text-start">
                                    <input type="text" name="otp" maxlength="6" required
                                        class="form-input mt-3 rounded-md" placeholder="Enter OTP">
                                </div>
                                <div class="mb-4">
                                    <button type="submit"
                                        class="w-full py-2 px-4 bg-emerald-600 text-white rounded-md text-lg hover:bg-emerald-700 transition duration-300">
                                        Verify OTP
                                    </button>
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