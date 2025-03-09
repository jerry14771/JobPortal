<?php
@include 'ipHandler.php';

if (isset($_GET['jobid']) && is_numeric($_GET['jobid'])) {
    $job_id = (int) $_GET['jobid'];

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM job_post WHERE status = ? AND job_id = ?");
        $status = 'Active';
        $stmt->bind_param("si", $status, $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
        } else {
            header("Location: index.php");
            exit;
        }
    } else {
        die("Database connection error!");
    }
} else {
    header("Location: index.php");
    exit;
}

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

    <?php
    include('header.php');
    ?>

    <section class="bg-slate-50 dark:bg-slate-800 md:py-24 py-16">
        <div class="container mt-10">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-8 md:col-span-6">
                    <div
                        class="md:flex items-center p-6 shadow-sm dark:shadow-gray-700 rounded-md bg-white dark:bg-slate-900">
                        <img src="<?php echo str_replace('../', '', $row['logo_url']); ?>"
                            class="rounded-full size-28 p-4 bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700"
                            alt="No Company Logo">

                        <div class="md:ms-4 md:mt-0 mt-6">
                            <h5 class="text-xl font-semibold"><?= $row['job_title']; ?></h5>
                            <div class="mt-2">
                                <span class="text-slate-400 font-medium me-2 inline-block"><i
                                        class="uil uil-building text-[18px] text-emerald-600 me-1"></i><?= $row['company_name']; ?></span>
                                <span class="text-slate-400 font-medium me-2 inline-block"><i
                                        class="uil uil-map-marker text-[18px] text-emerald-600 me-1"></i><?= $row['location']; ?></span>
                            </div>
                        </div>
                    </div>

                    <?php echo $row['job_description']; ?>

                    <div class="mt-5">
                        <a href="<?php echo $row['job_url'];?>"
                            class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto" target="_blank">Apply
                            Now</a>
                    </div>
                </div>

                <div class="lg:col-span-4 md:col-span-6">
                    <div class="shadow-sm dark:shadow-gray-700 rounded-md bg-white dark:bg-slate-900 sticky top-20">
                        <div class="p-6">
                            <h5 class="text-lg font-semibold">Job Information</h5>
                        </div>
                        <div class="p-6 border-t border-slate-100 dark:border-t-gray-700">
                            <ul class="list-none">
                                <li class="flex items-center">
                                    <i data-feather="user-check" class="size-5"></i>

                                    <div class="ms-4">
                                        <p class="font-medium">Employee Type:</p>
                                        <span
                                            class="text-emerald-600 font-medium text-sm"><?= $row['job_type']; ?></span>
                                    </div>
                                </li>

                                <li class="flex items-center mt-3">
                                    <i data-feather="map-pin" class="size-5"></i>

                                    <div class="ms-4">
                                        <p class="font-medium">Location:</p>
                                        <span
                                            class="text-emerald-600 font-medium text-sm"><?= $row['location']; ?></span>
                                    </div>
                                </li>

                                <li class="flex items-center mt-3">
                                    <i data-feather="monitor" class="size-5"></i>

                                    <div class="ms-4">
                                        <p class="font-medium">Job Category:</p>
                                        <span
                                            class="text-emerald-600 font-medium text-sm"><?= $row['job_categories']; ?></span>
                                    </div>
                                </li>

                                <li class="flex items-center mt-3">
                                    <i data-feather="briefcase" class="size-5"></i>

                                    <div class="ms-4">
                                        <p class="font-medium">Experience:</p>
                                        <span
                                            class="text-emerald-600 font-medium text-sm"><?= $row['experience']; ?></span>
                                    </div>
                                </li>

                                <li class="flex items-center mt-3">
                                    <i data-feather="book" class="size-5"></i>

                                    <div class="ms-4">
                                        <p class="font-medium">Qualifications:</p>
                                        <span
                                            class="text-emerald-600 font-medium text-sm"><?= $row['qualification']; ?></span>
                                    </div>
                                </li>

                                <li class="flex items-center mt-3">
                                    <i data-feather="dollar-sign" class="size-5"></i>

                                    <div class="ms-4">
                                        <p class="font-medium">Salary:</p>
                                        <span
                                            class="text-emerald-600 font-medium text-sm"><?php echo date($row['salary_min'] . '-' . $row['salary_max']); ?></span>
                                    </div>
                                </li>

                                <li class="flex items-center mt-3">
                                    <i data-feather="clock" class="size-5"></i>

                                    <div class="ms-4">
                                        <p class="font-medium">Date posted:</p>
                                        <span
                                            class="text-emerald-600 font-medium text-sm"><?php echo date('M d, Y', strtotime($row['date_posted'])); ?></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container lg:mt-24 mt-16">
            <div class="grid grid-cols-1 text-center">
                <h3 class=" md:text-[26px] md:leading-normal text-2xl leading-normal font-semibold">Related Vacancies
                </h3>
            </div>

            <!-- <div class="grid lg:grid-cols-3 md:grid-cols-2 mt-8 gap-[30px]">
                <div class="group shadow-sm dark:shadow-gray-700 p-6 rounded-md bg-white dark:bg-slate-900">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/facebook-logo.png" class="size-8" alt="">
                            </div>

                            <div class="ms-3">
                                <a href="employer-detail.html"
                                    class="block text-[16px] font-semibold hover:text-emerald-600 transition-all duration-500">Facebook</a>
                                <span class="block text-sm text-slate-400">2 days ago</span>
                            </div>
                        </div>

                        <span
                            class="bg-emerald-600/10 group-hover:bg-emerald-600 inline-block text-emerald-600 group-hover:text-white text-xs px-2.5 py-0.5 font-semibold rounded-full transition-all duration-500">Full
                            Time</span>
                    </div>

                    <div class="mt-6">
                        <a href="job-detail-one.html"
                            class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500">Web
                            Designer / Developer</a>
                        <h6 class="text-base font-medium"><i class="uil uil-map-marker"></i> Australia</h6>
                    </div>

                    <div class="mt-6">
                        <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-[6px]">
                            <div class="bg-emerald-600 h-[6px] rounded-full" style="width: 55%"></div>
                        </div>
                        <div class="mt-2">
                            <span class="text-slate-400 text-sm"><span
                                    class="text-slate-900 dark:text-white font-semibold inline-block">21 applied</span>
                                of 40 vacancy</span>
                        </div>
                    </div>
                </div>

                <div class="group shadow-sm dark:shadow-gray-700 p-6 rounded-md bg-white dark:bg-slate-900">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/google-logo.png" class="size-8" alt="">
                            </div>

                            <div class="ms-3">
                                <a href="employer-detail.html"
                                    class="block text-[16px] font-semibold hover:text-emerald-600 transition-all duration-500">Google</a>
                                <span class="block text-sm text-slate-400">2 days ago</span>
                            </div>
                        </div>

                        <span
                            class="bg-emerald-600/10 group-hover:bg-emerald-600 inline-block text-emerald-600 group-hover:text-white text-xs px-2.5 py-0.5 font-semibold rounded-full transition-all duration-500">Part
                            Time</span>
                    </div>

                    <div class="mt-6">
                        <a href="job-detail-one.html"
                            class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500">Marketing
                            Director</a>
                        <h6 class="text-base font-medium"><i class="uil uil-map-marker"></i> USA</h6>
                    </div>

                    <div class="mt-6">
                        <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-[6px]">
                            <div class="bg-emerald-600 h-[6px] rounded-full" style="width: 55%"></div>
                        </div>
                        <div class="mt-2">
                            <span class="text-slate-400 text-sm"><span
                                    class="text-slate-900 dark:text-white font-semibold inline-block">21 applied</span>
                                of 40 vacancy</span>
                        </div>
                    </div>
                </div>

                <div class="group shadow-sm dark:shadow-gray-700 p-6 rounded-md bg-white dark:bg-slate-900">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                <img src="assets/images/company/android.png" class="size-8" alt="">
                            </div>

                            <div class="ms-3">
                                <a href="employer-detail.html"
                                    class="block text-[16px] font-semibold hover:text-emerald-600 transition-all duration-500">Android</a>
                                <span class="block text-sm text-slate-400">2 days ago</span>
                            </div>
                        </div>

                        <span
                            class="bg-emerald-600/10 group-hover:bg-emerald-600 inline-block text-emerald-600 group-hover:text-white text-xs px-2.5 py-0.5 font-semibold rounded-full transition-all duration-500">Remote</span>
                    </div>

                    <div class="mt-6">
                        <a href="job-detail-one.html"
                            class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500">Application
                            Developer</a>
                        <h6 class="text-base font-medium"><i class="uil uil-map-marker"></i> China</h6>
                    </div>

                    <div class="mt-6">
                        <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-[6px]">
                            <div class="bg-emerald-600 h-[6px] rounded-full" style="width: 55%"></div>
                        </div>
                        <div class="mt-2">
                            <span class="text-slate-400 text-sm"><span
                                    class="text-slate-900 dark:text-white font-semibold inline-block">21 applied</span>
                                of 40 vacancy</span>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>

    <?php @include("footer.php"); ?>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/plugins.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>