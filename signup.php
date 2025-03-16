<?php 
include 'mailer.php';
?>

<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
    
<head>
        <meta charset="UTF-8">
        <title>Jobstack - Job Portal Tailwind CSS Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Job Listing Landing Template" name="description">
        <meta content="Job, CV, Career, Resume, Job Portal, Create Job, Post job, tailwind Css" name="keywords">
        <meta name="version" content="1.6.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Css -->
        <!-- Main Css -->
        <link href="assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet">
        <link href="assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/tailwind.min.css" rel="stylesheet" type="text/css">

    </head>
    
    <body class="dark:bg-slate-900">
        <!-- Loader Start -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div>
        <!-- Loader End -->
        <section class="h-screen flex items-center justify-center relative overflow-hidden bg-[url('../../assets/images/hero/bg3.html')] bg-no-repeat bg-center bg-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-900"></div>
            <div class="container">
                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1">
                    <div class="relative overflow-hidden bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                        <div class="p-6">
                            <a href="#">
                            <img src="assets/logo/Pixel_Apply_new.png" class="mx-auto h-[48px] block dark:hidden"
                            alt="">
                            </a>
                            <h5 class="my-6 text-xl font-semibold">Signup</h5>
                            <form action="mailer.php" method="POST" class="text-start">
                                <div class="grid grid-cols-1">
                                    <div class="mb-4 text-start">
                                        <label class="font-semibold" for="RegisterName">Your Name:</label>
                                        <input id="RegisterName" name="user_name" type="text" class="form-input mt-3 rounded-md" placeholder="Harry">
                                    </div>
    
                                    <div class="mb-4 text-start">
                                        <label class="font-semibold" for="LoginEmail">Email Address:</label>
                                        <input id="LoginEmail" name="email" type="email" class="form-input mt-3 rounded-md" placeholder="name@example.com">
                                    </div>
    
                                    <div class="mb-4 text-start">
                                        <label class="font-semibold" for="LoginPassword">Password:</label>
                                        <input id="LoginPassword" name="password" type="password" class="form-input mt-3 rounded-md" placeholder="Password:">
                                    </div>
    
                                    <div class="mb-4">
                                        <input type="submit" class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-md w-full" value="Register">
                                    </div>
    
                                    <div class="text-center">
                                        <span class="text-slate-400 me-2">Already have an account ? </span> <a href="login.php" class="text-slate-900 dark:text-white font-bold">Sign in</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--end section -->

        <div class="fixed bottom-3 end-3">
            <a href="#" class="back-button size-9 inline-flex items-center text-center justify-center text-base font-semibold tracking-wide border align-middle transition duration-500 ease-in-out bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-md"><i data-feather="arrow-left" class="size-4"></i></a>
        </div>

        <!-- Switcher -->
       

      
        <!-- LTR & RTL Mode Code -->

        <!-- JAVASCRIPTS -->
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/plugins.init.js"></script>
        <script src="assets/js/app.js"></script>
        <!-- JAVASCRIPTS -->
    </body>

</html>