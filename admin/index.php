<?php 
include "AuthCheck.php";
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
        
        <?php include("nav.php"); ?>

      
        <div class="relative">
            <div class="shape absolute start-0 end-0 sm:-bottom-px -bottom-[2px] overflow-hidden z-1 text-slate-50 dark:text-slate-800">
                <svg class="w-full h-auto" viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        <!-- End Hero -->

        <!-- Start -->
        <section class="relative bg-slate-50 dark:bg-slate-800 lg:py-24 py-16">
            <div class="container">
                <div class="lg:flex justify-center">
                    <div class="lg:w-2/3">
                        <div class="p-6 bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                            <form class="text-start">
                                <div class="grid grid-cols-1">
                                    <h5 class="text-lg font-semibold">Job Details:</h5>
                                </div>

                                <div class="grid grid-cols-12 gap-4 mt-4">
                                    <div class="col-span-12 text-start">
                                        <label class="font-semibold" for="RegisterName">Job Title:</label>
                                        <input id="RegisterName" type="text" class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1" placeholder="Web Developer">
                                    </div>

                                    <div class="col-span-12 text-start">
                                        <label for="comments" class="font-semibold">Job Description:</label>
                                        <textarea name="comments" id="comments" class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-28 outline-none bg-transparent mt-1 textarea" placeholder="Write Job Description :"></textarea>
                                    </div>

                                    <div class="md:col-span-6 col-span-12 text-start">
                                        <label class="font-semibold">Job Categories:</label>
                                        <select class="form-select w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent block mt-1">
                                            <option value="WD">Web Designer</option>
                                            <option value="WD">Web Developer</option>
                                            <option value="UI">UI / UX Desinger</option>
                                        </select>
                                    </div>

                                    <div class="md:col-span-6 col-span-12 text-start">
                                        <label class="font-semibold">Job Type:</label>
                                        <select class="form-select w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent block mt-1">
                                            <option value="FT">Full Time</option>
                                            <option value="PT">Part Time</option>
                                            <option value="WFH">Work From Home</option>
                                            <option value="RJ">Remote Job</option>
                                        </select>
                                    </div>

                                    <div class="md:col-span-6 col-span-12 text-start">
                                        <label class="font-semibold">Salary:</label>
                                        <select class="form-select w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent block mt-1">
                                            <option value="HOURL">Hourly</option>
                                            <option value="MONTH">Monthly</option>
                                        </select>
                                    </div>

                                    <div class="md:col-span-3 col-span-12 text-start">
                                        <label class="font-semibold md:invisible md:block hidden">Min:</label>
                                        <div class="relative mt-1">
                                            <span class="size-10 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-800 absolute top-0 start-0 overflow-hidden rounded">
                                                <i data-feather="dollar-sign" class="size-4 absolute top-3 start-3"></i>
                                            </span>
                                            <input type="number" class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent ps-12" placeholder="min" name="minsalary">
                                        </div>
                                    </div>

                                    <div class="md:col-span-3 col-span-12 text-start">
                                        <label class="font-semibold md:invisible md:block hidden">Max:</label>
                                        <div class="relative mt-1">
                                            <span class="size-10 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-800 absolute top-0 start-0 overflow-hidden rounded">
                                                <i data-feather="dollar-sign" class="size-4 absolute top-3 start-3"></i>
                                            </span>
                                            <input type="number" class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent ps-12" placeholder="max" name="maxsalary">
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 mt-8">
                                    <h5 class="text-lg font-semibold">Skill & Experience:</h5>
                                </div>

                                <div class="grid grid-cols-12 gap-4 mt-4">
                                    <div class="col-span-12 text-start">
                                        <label class="font-semibold" for="Skillname">Skills:</label>
                                        <input id="Skillname" type="text" class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1" placeholder="Web Developer">
                                    </div>

                                    <div class="md:col-span-6 col-span-12 text-start">
                                        <label class="font-semibold" for="Qualificationname">Qualifications:</label>
                                        <input id="Qualificationname" type="text" class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1" placeholder="Qualifications">
                                    </div>

                                    <div class="md:col-span-6 col-span-12 text-start">
                                        <label class="font-semibold" for="Experiencename">Experience:</label>
                                        <input id="Experiencename" type="text" class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1" placeholder="Experience">
                                    </div>

                                    <div class="md:col-span-6 col-span-12 text-start">
                                        <label class="font-semibold">Industry:</label>
                                        <select class="form-select w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent block mt-1">
                                            <option value="BANK">Banking</option>
                                            <option value="BIO">Biotechnology</option>
                                            <option value="AVI">Aviation</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 mt-8">
                                    <h5 class="text-lg font-semibold">Address:</h5>
                                </div>

                                <div class="grid grid-cols-12 gap-4 mt-4">
                                    <div class="col-span-12 text-start">
                                        <label class="font-semibold" for="Address">Address:</label>
                                        <input id="Address" type="text" class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1" placeholder="Address">
                                    </div>
                                    
                                    <div class="md:col-span-4 col-span-12 text-start">
                                        <label class="font-semibold">Country:</label>
                                        <select class="form-select w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent block mt-1">
                                            <option value="USA">USA</option>
                                            <option value="CAD">Canada</option>
                                            <option value="CHINA">China</option>
                                        </select>
                                    </div>

                                    <div class="md:col-span-4 col-span-12 text-start">
                                        <label class="font-semibold">State:</label>
                                        <select class="form-select w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent block mt-1">
                                            <option value="CAL">California</option>
                                            <option value="TEX">Texas</option>
                                            <option value="FLOR">Florida</option>
                                        </select>
                                    </div>

                                    <div class="col-span-12 text-start">
                                        <div class="w-full leading-[0] border-0">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin" style="border:0" class="w-full h-[200px] rounded shadow" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-4 mt-4">
                                    <div>
                                        <button type="submit" id="submit" name="send" class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white">Post Now</button>
                                    </div>
                                </div>
                            </form><!--end form-->
                        </div>
                    </div>
                </div><!--end flex-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->

        <!-- Start Footer -->
      <?php @include("../footer.php");?>
        <!-- End Footer -->
      
        <!-- Switcher -->

    

        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-emerald-600 text-white justify-center items-center"><i class="uil uil-arrow-up"></i></a>
        <!-- Back to top -->

        <!-- JAVASCRIPTS -->
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/plugins.init.js"></script>
        <script src="assets/js/app.js"></script>
        <!-- JAVASCRIPTS -->
    </body>

</html>