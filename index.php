 <?php
@include('ipHandler.php');
?> 

<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
    
<head>
        <meta charset="UTF-8">
        <title>Pixel Apply - Find Your Dream Job</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Job Listing Landing Template" name="description">
        <meta content="Job, CV, Career, Resume, Job Portal, Create Job, Post job, tailwind Css" name="keywords">
        <meta name="version" content="1.6.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Css -->
        <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet">
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
        <?php 
        
        @include("header.php");
        ?>

        <!-- Start Hero -->
        <section class="relative table w-full py-12 bg-[url('../../assets/images/hero/bg.html')] bg-top bg-no-repeat bg-cover">
            <!-- <div class="absolute inset-0 bg-emerald-900/90"></div>
            <div class="container">
                <div class="grid grid-cols-1 text-center mt-10">
                    <h3 class="md:text-3xl text-2xl md:leading-snug tracking-wide leading-snug font-medium text-white">Latest Job Vacancies</h3>
                </div>
            </div> -->
        </section>
        <div class="relative">
            <div class="shape absolute start-0 end-0 sm:-bottom-px -bottom-[2px] overflow-hidden z-1 text-white dark:text-slate-900">
                <svg class="w-full h-auto" viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        <!-- End Hero -->

        <!-- Start -->
        <section class="relative -mt-[42px] md:pb-24 pb-16">
            <div class="container mt-10">
                <div class="grid grid-cols-1 gap-[30px]">
                    <div class="group relative overflow-hidden md:flex justify-between items-center rounded shadow-sm hover:shadow-md dark:shadow-gray-700 transition-all duration-500 p-5">
                        <div class="flex items-center">
                            <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/facebook-logo.png" class="size-8"  alt="">
                            </div>
                            <a href="job-detail-two.php" class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[180px]">Web Designer</a>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-4">
                            <span class="block"><span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">Full Time</span></span>
                            <span class="block text-slate-400 text-sm md:mt-1 mt-0"><i class="uil uil-clock"></i> 20th Feb 2023</span>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-2">
                            <span class="text-slate-400"><i class="uil uil-map-marker"></i> Australia</span>
                            <span class="block font-semibold md:mt-1 mt-0">$4,000 - $4,500</span>
                        </div>

                        <div class="md:mt-0 mt-4">
                            <a href="#" class="size-9 font-semibold tracking-wide border align-middle transition duration-500 ease-in-out inline-flex items-center text-center justify-center text-base rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3"><i data-feather="bookmark" class="size-4"></i></a>
                            <a href="job-detail-two.php" class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Apply Now</a>
                        </div>

                        <span class="w-24 bg-yellow-400 text-white text-center absolute ltr:-rotate-45 rtl:rotate-45 -start-[30px] top-1"><i class="uil uil-star"></i></span>
                    </div><!--end content-->
                    
                    <div class="group relative overflow-hidden md:flex justify-between items-center rounded shadow-sm hover:shadow-md dark:shadow-gray-700 transition-all duration-500 p-5">
                        <div class="flex items-center">
                            <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/google-logo.png" class="size-8"  alt="">
                            </div>
                            <a href="job-detail-two.php" class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[180px]">Marketing Director</a>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-4">
                            <span class="block"><span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">Part Time</span></span>
                            <span class="block text-slate-400 text-sm md:mt-1 mt-0"><i class="uil uil-clock"></i> 20th Feb 2023</span>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-2">
                            <span class="text-slate-400"><i class="uil uil-map-marker"></i> USA</span>
                            <span class="block font-semibold md:mt-1 mt-0">$4,000 - $4,500</span>
                        </div>

                        <div class="md:mt-0 mt-4">
                            <a href="#" class="size-9 font-semibold tracking-wide border align-middle transition duration-500 ease-in-out inline-flex items-center text-center justify-center text-base rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3"><i data-feather="bookmark" class="size-4"></i></a>
                            <a href="job-detail-two.php" class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Apply Now</a>
                        </div>
                    </div><!--end content-->
                    
                    <div class="group relative overflow-hidden md:flex justify-between items-center rounded shadow-sm hover:shadow-md dark:shadow-gray-700 transition-all duration-500 p-5">
                        <div class="flex items-center">
                            <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/android.png" class="size-8"  alt="">
                            </div>
                            <a href="job-detail-two.php" class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[180px]">App Developer</a>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-4">
                            <span class="block"><span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">Remote</span></span>
                            <span class="block text-slate-400 text-sm md:mt-1 mt-0"><i class="uil uil-clock"></i> 20th Feb 2023</span>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-2">
                            <span class="text-slate-400"><i class="uil uil-map-marker"></i> China</span>
                            <span class="block font-semibold md:mt-1 mt-0">$4,000 - $4,500</span>
                        </div>

                        <div class="md:mt-0 mt-4">
                            <a href="#" class="size-9 font-semibold tracking-wide border align-middle transition duration-500 ease-in-out inline-flex items-center text-center justify-center text-base rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3"><i data-feather="bookmark" class="size-4"></i></a>
                            <a href="job-detail-two.php" class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Apply Now</a>
                        </div>
                    </div><!--end content-->
                    
                    <div class="group relative overflow-hidden md:flex justify-between items-center rounded shadow-sm hover:shadow-md dark:shadow-gray-700 transition-all duration-500 p-5">
                        <div class="flex items-center">
                            <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/lenovo-logo.png" class="size-8"  alt="">
                            </div>
                            <a href="job-detail-two.php" class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[180px]">Product Designwer</a>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-4">
                            <span class="block"><span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">WFH</span></span>
                            <span class="block text-slate-400 text-sm md:mt-1 mt-0"><i class="uil uil-clock"></i> 20th Feb 2023</span>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-2">
                            <span class="text-slate-400"><i class="uil uil-map-marker"></i> Dubai</span>
                            <span class="block font-semibold md:mt-1 mt-0">$4,000 - $4,500</span>
                        </div>

                        <div class="md:mt-0 mt-4">
                            <a href="#" class="size-9 font-semibold tracking-wide border align-middle transition duration-500 ease-in-out inline-flex items-center text-center justify-center text-base rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3"><i data-feather="bookmark" class="size-4"></i></a>
                            <a href="job-detail-two.php" class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Apply Now</a>
                        </div>
                    </div><!--end content-->
                    
                    <div class="group relative overflow-hidden md:flex justify-between items-center rounded shadow-sm hover:shadow-md dark:shadow-gray-700 transition-all duration-500 p-5">
                        <div class="flex items-center">
                            <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/spotify.png" class="size-8"  alt="">
                            </div>
                            <a href="job-detail-two.php" class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[180px]">C++ Developer</a>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-4">
                            <span class="block"><span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">Full Time</span></span>
                            <span class="block text-slate-400 text-sm md:mt-1 mt-0"><i class="uil uil-clock"></i> 20th Feb 2023</span>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-2">
                            <span class="text-slate-400"><i class="uil uil-map-marker"></i> India</span>
                            <span class="block font-semibold md:mt-1 mt-0">$4,000 - $4,500</span>
                        </div>

                        <div class="md:mt-0 mt-4">
                            <a href="#" class="size-9 font-semibold tracking-wide border align-middle transition duration-500 ease-in-out inline-flex items-center text-center justify-center text-base rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3"><i data-feather="bookmark" class="size-4"></i></a>
                            <a href="job-detail-two.php" class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Apply Now</a>
                        </div>

                        <span class="w-24 bg-yellow-400 text-white text-center absolute ltr:-rotate-45 rtl:rotate-45 -start-[30px] top-1"><i class="uil uil-star"></i></span>
                    </div><!--end content-->
                    
                    <div class="group relative overflow-hidden md:flex justify-between items-center rounded shadow-sm hover:shadow-md dark:shadow-gray-700 transition-all duration-500 p-5">
                        <div class="flex items-center">
                            <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/linkedin.png" class="size-8"  alt="">
                            </div>
                            <a href="job-detail-two.php" class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[180px]">Php Developer</a>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-4">
                            <span class="block"><span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold rounded-full">Remote</span></span>
                            <span class="block text-slate-400 text-sm md:mt-1 mt-0"><i class="uil uil-clock"></i> 20th Feb 2023</span>
                        </div>

                        <div class="md:block flex justify-between md:mt-0 mt-2">
                            <span class="text-slate-400"><i class="uil uil-map-marker"></i> Pakistan</span>
                            <span class="block font-semibold md:mt-1 mt-0">$4,000 - $4,500</span>
                        </div>

                        <div class="md:mt-0 mt-4">
                            <a href="#" class="size-9 font-semibold tracking-wide border align-middle transition duration-500 ease-in-out inline-flex items-center text-center justify-center text-base rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3"><i data-feather="bookmark" class="size-4"></i></a>
                            <a href="job-detail-two.php" class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Apply Now</a>
                        </div>

                        <span class="w-24 bg-yellow-400 text-white text-center absolute ltr:-rotate-45 rtl:rotate-45 -start-[30px] top-1"><i class="uil uil-star"></i></span>
                    </div><!--end content-->

                   
                    
                </div><!--end grid-->
            </div><!--end container-->

            <div class="container md:mt-24 mt-16">
                <div class="grid grid-cols-1 pb-8 text-center">
                    <h3 class="mb-4 md:text-[26px] md:leading-normal text-2xl leading-normal font-semibold">Here's why you'll love it  'Pixel Apply'</h3>

                    <p class="text-slate-400 max-w-xl mx-auto">Search all the open positions on the web. Get your own personalized salary estimate.</p>
                </div><!--end grid-->

               
            </div><!--end container-->

           
        </section><!--end section-->
        <!-- End -->



        <!-- Start Footer -->
       <?php @include("footer.php");?>
        <!-- Back to top -->

        <!-- JAVASCRIPTS -->
        <script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/plugins.init.js"></script>
        <script src="assets/js/app.js"></script>
        <!-- JAVASCRIPTS -->
    </body>

</html>