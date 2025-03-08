<?php
@include 'ipHandler.php';
// 

$limit = 10;  // Jobs per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total number of jobs
$totalStmt = $conn->prepare("SELECT COUNT(*) as total FROM job_post");
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalJobs = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalJobs / $limit);

// Fetch jobs for the current page
$stmt = $conn->prepare("SELECT * FROM job_post Where status=? ORDER BY date_posted DESC LIMIT ? OFFSET ?");
$status = 'Active';
$stmt->bind_param("sii", $status, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
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
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet">
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
    <?php

    @include("header.php");
    ?>
    <section
        class="relative table w-full py-12 bg-[url('../../assets/images/hero/bg.html')] bg-top bg-no-repeat bg-cover">
    </section>
    <div class="relative">
        <div
            class="shape absolute start-0 end-0 sm:-bottom-px -bottom-[2px] overflow-hidden z-1 text-white dark:text-slate-900">
            <svg class="w-full h-auto" viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <section class="relative -mt-[42px] md:pb-24 pb-16">
        <div class="container mt-10">
            <div class="grid grid-cols-1 gap-[30px]">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div
                            class="group relative overflow-hidden md:flex justify-between items-center rounded shadow-sm hover:shadow-md dark:shadow-gray-700 transition-all duration-500 p-5">
                            <div class="flex items-center">
                                <div
                                    class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                                    <img src="<?php echo str_replace('../', '', $row['logo_url']); ?>" class="size-14" alt="">
                                </div>
                                <a href="job-detail-two.php?jobid=<?=$row['job_id'];?>"
                                    class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[180px]"><?= $row['job_title'];?></a>
                            </div>

                            <div class="md:block flex justify-between md:mt-0 mt-4">
                                <span class="block"><span
                                        class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold rounded-full"><?= $row['job_type'];?></span></span>
                                <span class="block text-slate-400 text-sm md:mt-1 mt-0"><i class="uil uil-clock"></i><?php echo date('M d, Y', strtotime($row['date_posted'])); ?></span>
                            </div>

                            <div class="md:block flex justify-between md:mt-0 mt-2">
                                <span class="text-slate-400"><i class="uil uil-map-marker"></i> <?php echo $row['location'];?></span>
                                <span class="block font-semibold md:mt-1 mt-0"><?php echo date($row['salary_min'] .'-'.$row['salary_max']);?></span>
                            </div>
                            <div class="md:mt-0 mt-4">
                                <a href="#"
                                    class="size-9 font-semibold tracking-wide border align-middle transition duration-500 ease-in-out inline-flex items-center text-center justify-center text-base rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3"><i
                                        data-feather="bookmark" class="size-4"></i></a>
                                <a href="job-detail-two.php?jobid=<?=$row['job_id'];?>"
                                    class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Apply
                                    Now</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid md:grid-cols-12 grid-cols-1 mt-8">
    <div class="md:col-span-12 text-center">
        <nav aria-label="Page navigation example">
            <ul class="inline-flex items-center -space-x-px">
                <!-- Previous Button -->
                <?php if ($page > 1): ?>
                    <li>
                        <a href="?page=<?= $page - 1 ?>" class="size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-3xl hover:text-white border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600">
                            <i class="uil uil-angle-left text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Dynamic Page Numbers -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li>
                        <a href="?page=<?= $i ?>" class="size-[40px] inline-flex justify-center items-center <?= $page == $i ? 'text-white bg-emerald-600 border border-emerald-600' : 'text-slate-400 hover:text-white bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- Next Button -->
                <?php if ($page < $totalPages): ?>
                    <li>
                        <a href="?page=<?= $page + 1 ?>" class="size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-3xl hover:text-white border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600">
                            <i class="uil uil-angle-right text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>



        <div class="container md:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-4 md:text-[26px] md:leading-normal text-2xl leading-normal font-semibold">Here's why
                    you'll love it 'Pixel Apply'</h3>
                <p class="text-slate-400 max-w-xl mx-auto">Search all the open positions on the web. Get your own
                    personalized salary estimate.</p>
            </div>
        </div>
    </section>
    <?php @include "footer.php"; ?>
    <script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/plugins.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>