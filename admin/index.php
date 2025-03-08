<?php
// include "AuthCheck.php";
include '../config.php';


if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}


$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$stmt = $conn->prepare("SELECT skills, qualification, experience,`location`,job_id, job_title, job_categories, job_type, salary_min, salary_max, date_posted, `status` FROM job_post ORDER BY date_posted DESC ");
$stmt->execute();
$result = $stmt->get_result();
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .pagination {
            margin: 20px 0;
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ddd;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>

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
        <div
            class="shape absolute start-0 end-0 sm:-bottom-px -bottom-[2px] overflow-hidden z-1 text-slate-50 dark:text-slate-800">
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
                <table class="min-w-full bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700">
                    <thead>
                        <tr class="bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-200">
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Job Title</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Categories</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Job Type</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Salary Min</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Salary Max</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Skills</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Qualification</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Experience</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Location</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Status</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Date Posted</th>
                            <th class="px-4 py-2 border border-slate-300 dark:border-slate-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="text-slate-900 dark:text-slate-200">
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700">
                                        <?= $row['job_title']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700">
                                        <?= $row['job_categories']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700"><?= $row['job_type']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700">
                                        <?= $row['salary_min']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700">
                                        <?= $row['salary_max']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700"><?= $row['skills']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700">
                                        <?= $row['qualification']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700">
                                        <?= $row['experience']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700"><?= $row['location']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700"><?= $row['status']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700">
                                        <?= $row['date_posted']; ?>
                                    </td>
                                    <td class="px-4 py-2 border border-slate-300 dark:border-slate-700 text-center">
                                       
                                        <form method="POST" action="job-post.php"
                                            onsubmit="return confirm('Are you sure you want to edit this job?');">
                                            <input type="hidden" name="edit_job_id" value="<?= $row['job_id']; ?>">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                            <button name="edit_job" type="submit" class="text-red-500 hover:text-red-700 mx-1">
                                            <i class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="job-post-backend.php"
                                            onsubmit="return confirm('Are you sure you want to delete this job?');">
                                            <input type="hidden" name="job_id" value="<?= $row['job_id']; ?>">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                            <button name="delete_job" type="submit" class="text-red-500 hover:text-red-700 mx-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                <?php endwhile; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="8">No jobs found.</td>
                            </tr>
                        <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <script>
        $(document).ready(function () {
            $('table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10,
                lengthChange: true
            });
        });
    </script>
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- End -->

    <!-- Start Footer -->
    <?php @include("../footer.php"); ?>
    <!-- End Footer -->

    <!-- Switcher -->



    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top"
        class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-emerald-600 text-white justify-center items-center"><i
            class="uil uil-arrow-up"></i></a>
    <!-- Back to top -->

    <!-- JAVASCRIPTS -->
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/plugins.init.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- JAVASCRIPTS -->
</body>

</html>