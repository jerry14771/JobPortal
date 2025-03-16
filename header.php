<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<head>

    <meta charset="UTF-8">
    <title>Pixel Apply - Find Your Dream Job</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Find the latest IT jobs and apply directly. No signup required!" name="description">
    <meta content="Job, CV, Career, Resume, Job Portal, Freshers Job, IT Jobs, Experienced Jobs, High Paying It Jobs"
        name="keywords">
    <link rel="canonical" href="https://pixelapply.com/" />
    <meta name="version" content="1.6.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet">
    <link href="assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet">
    <link href="assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/tailwind.min.css" rel="stylesheet" type="text/css">
    <meta property="og:updated_time" content="<?php echo date('c'); ?>">
    <meta property="og:title" content="PixelApply - Find Your Dream Job">
    <meta property="og:description" content="Find the latest IT jobs and apply directly. No signup required!">
    <meta property="og:image" content="https://www.pixelapply.com/assets/images/og-image.jpg">
    <meta property="og:url" content="https://www.pixelapply.com">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="PixelApply - Find Your Dream Job">
    <meta name="twitter:description" content="Find the latest IT jobs and apply directly. No signup required!">
    <meta name="twitter:image" content="https://www.pixelapply.com/assets/images/og-image.jpg">

</head>

<body class="dark:bg-slate-900">

    <style>
        @media (max-width: 768px) {
            .custom-class {
                display: none;
            }
        }
    </style>
    <nav id="topnav" class="defaultscroll is-sticky">
        <div class="container">
            <!-- Logo container-->
            <a class="logo" href="index.php">
                <div class="block sm:hidden">
                    <img src="assets/logo/Pixel_Apply_new.png" class="inline-block dark:hidden" style="height:30px"
                        alt="LOGO">
                </div>
                <div class="sm:block hidden">
                    <img src="assets/logo/Pixel_Apply_new.png" class="inline-block dark:hidden" style="height: 35px;"
                        alt="LOGO">
                </div>
            </a>

            <div class="menu-extras">
                <div class="menu-item">
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>

            <ul class="buy-button list-none mb-0">

                <?php if (!isset($_SESSION['email'])) { ?>
                    <li class="dropdown inline-block relative ps-1" style="">
                        <a href="login.php"
                            style="color: white; font-weight: 700; font-size: 16px;padding: 8px 10px; border-radius: 5px; background: #009966;"
                            class="sub-menu-item">Login</a>
                    </li>


                <?php } else { ?>

                    <li class="dropdown inline-block relative ps-1">
                        <button data-dropdown-toggle="dropdown" class="dropdown-toggle items-center" type="button">
                            <span
                                class="size-9 inline-flex items-center text-center justify-center text-base font-semibold tracking-wide border align-middle transition duration-500 ease-in-out rounded-full bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white"><img
                                    src="assets/images/profile.png" class="rounded-full" alt="Profile"></span>
                        </button>
                        <div class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-44 rounded-md overflow-hidden bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 hidden"
                            onclick="event.stopPropagation();">
                            <ul class="py-2 text-start">
                                <li>
                                    <a href="candidate-profile.php"
                                        class="flex items-center font-medium py-2 px-4 dark:text-white/70 hover:text-emerald-600 dark:hover:text-white"><i
                                            data-feather="user" class="size-4 me-2"></i>Profile</a>
                                </li>

                                <li class="border-t border-gray-100 dark:border-gray-800 my-2"></li>
                                <li>
                                    <a href="logout.php"
                                        class="flex items-center font-medium py-2 px-4 dark:text-white/70 hover:text-emerald-600 dark:hover:text-white"><i
                                            data-feather="log-out" class="size-4 me-2"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>

            </ul>
            <div id="navigation">
                <ul class="navigation-menu nav-right !justify-end">
                    <li class="has-submenu parent-menu-item">
                        <a href="index.php">Home</a>
                    </li>

                    <li><a href="<?php echo !isset($_SESSION['email'])?'login.php': 'smart-apply.php'; ?>" class="sub-menu-item">Smart Apply<sup class="glowing-star">AI</sup></a></li>



                    <!-- <li><a href="#" class="sub-menu-item">Contact</a></li> -->
                </ul>
            </div>
        </div>
    </nav>

    <style>
        @keyframes neonGlow {
            0% {
                text-shadow: 0 0 5px #009966, 0 0 10px #009966, 0 0 15px #007755;
                opacity: 1;
            }

            50% {
                text-shadow: 0 0 10px #00cc99, 0 0 20px #009966, 0 0 30px #007755;
                opacity: 0.6;
            }

            100% {
                text-shadow: 0 0 5px #009966, 0 0 10px #009966, 0 0 15px #007755;
                opacity: 1;
            }
        }

        .glowing-star {
            color: #009966;
            font-size: 12px;
            margin: 0 5px;
            animation: neonGlow 1.5s infinite alternate;
        }
    </style>