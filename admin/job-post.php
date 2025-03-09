<?php

include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$edit_mode = false;

if (!isset($_POST['edit_job'])) {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token!');
    }
    if (isset($_POST['edit_job'])) {
        $edit_mode = true;
        $job_id = intval($_POST['edit_job_id']);

        $stmt = $conn->prepare("SELECT * FROM job_post WHERE job_id = ?");
        if ($stmt) {
            $stmt->bind_param('i', $job_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $job_data = $result->fetch_assoc();
            $stmt->close();
        }

    }
}

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
    <link href="assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet">
    <link href="assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/tailwind.min.css" rel="stylesheet" type="text/css">


    <!-- include summernote css/js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <!-- include summernote end css/js -->


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



    <!-- End Hero -->

    <!-- Start -->
    <section class="relative bg-slate-50 dark:bg-slate-800 lg:py-24 py-16">
        <div class="container">
            <div class="lg:flex justify-center">
                <div class="lg:w-2/3">
                    <div class="p-6 bg-white dark:bg-slate-900 shadow-sm dark:shadow-gray-700 rounded-md">
                        <form class="text-start" method="POST" action="job-post-backend.php" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <input type="hidden" name="edit_id" value="<?php echo isset($job_data['job_id']) ? $job_data['job_id'] : null; ?>">

                            <div class="grid grid-cols-1">
                                <h5 class="text-lg font-semibold">Job Details:</h5>
                            </div>

                            <div class="grid grid-cols-12 gap-4 mt-4">
                                <div class="col-span-12 text-start">
                                    <label class="font-semibold" for="company_name">Company Name:</label>
                                    <input id="company_name" type="text" name="company_name"
                                        value="<?php echo isset($job_data['company_name']) ? $job_data['company_name'] : ''; ?>"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1"
                                        placeholder="Google, Microsoft, etc...">
                                </div>
                                <div class="col-span-12 text-start">
                                    <label class="font-semibold" for="RegisterName">Job Title:</label>
                                    <input id="RegisterName" type="text" name="job_title"
                                        value="<?php echo isset($job_data['job_title']) ? $job_data['job_title'] : ''; ?>"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1"
                                        placeholder="Web Developer">
                                </div>
                                <div class="col-span-12 text-start">
                                    <label class="font-semibold" for="job_url">Job URL:</label>
                                    <input id="job_url" type="text" name="job_url"
                                        value="<?php echo isset($job_data['job_url']) ? $job_data['job_url'] : ''; ?>"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1"
                                        placeholder="https://">
                                </div>

                                <div class="col-span-12 text-start">
                                    <label class="font-semibold" for="logo_image">Logo Image</label>
                                    <input id="logo_image" type="file" name="logo_image" 
                                        class="w-full py-2 px-3 border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1">
                                </div>

                                <div class="col-span-12 text-start">
                                    <label for="comments" class="font-semibold">Job Description:</label>
                                    <textarea id="summernote"
                                        name="job_description"><?php echo isset($job_data['job_description']) ? $job_data['job_description'] : ''; ?></textarea>

                                </div>

                                <div class="md:col-span-6 col-span-12 text-start">
                                    <label class="font-semibold">Job Categories:</label>
                                    <select name="job_categories"
                                        class="form-select w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent block mt-1">
                                        <option value="Web Designer" <?php echo (isset($job_data['job_categories']) && $job_data['job_categories'] === 'Web Designer') ? 'selected' : ''; ?>>Web
                                            Designer</option>
                                        <option value="Web Developer" <?php echo (isset($job_data['job_categories']) && $job_data['job_categories'] === 'Web Developer') ? 'selected' : ''; ?>>Web
                                            Developer</option>
                                        <option value="UI / UX Desinger" <?php echo (isset($job_data['job_categories']) && $job_data['job_categories'] === 'UI / UX Desinger') ? 'selected' : ''; ?>>
                                            UI / UX Desinger</option>
                                        <option value="Automation" <?php echo (isset($job_data['job_categories']) && $job_data['job_categories'] === 'Automation') ? 'selected' : ''; ?>>
                                        Automation</option>
                                        <option value="Data Science" <?php echo (isset($job_data['job_categories']) && $job_data['job_categories'] === 'Data Science') ? 'selected' : ''; ?>>
                                        Data Science</option>
                                        <option value="Testing" <?php echo (isset($job_data['job_categories']) && $job_data['job_categories'] === 'Testing') ? 'selected' : ''; ?>>
                                        Testing</option>
                                    </select>
                                </div>

                                <div class="md:col-span-6 col-span-12 text-start">
                                    <label class="font-semibold">Job Type:</label>
                                    <select name="job_type"
                                        class="form-select w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent block mt-1">
                                        <option value="Full Time" <?php echo (isset($job_data['job_type']) && $job_data['job_type'] === 'Full Time') ? 'selected' : ''; ?>>Full Time</option>
                                        <option value="Part Time" <?php echo (isset($job_data['job_type']) && $job_data['job_type'] === 'Part Time') ? 'selected' : ''; ?>>Part Time</option>
                                        <option value="Work From Home" <?php echo (isset($job_data['job_type']) && $job_data['job_type'] === 'Work From Home') ? 'selected' : ''; ?>>Work From Home</option>
                                        <option value="Remote Job" <?php echo (isset($job_data['job_type']) && $job_data['job_type'] === 'Remote Job') ? 'selected' : ''; ?>>Remote Job</option>
                                    </select>
                                </div>

                                <div class="md:col-span-6 col-span-12 text-start">
                                    <label class="font-semibold">Min Salary:</label>
                                    <div class="md:col-span-3 col-span-12 text-start">
                                        <div class="relative mt-1">
                                            <span
                                                class="size-10 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-800 absolute top-0 start-0 overflow-hidden rounded">
                                                <i data-feather="dollar-sign" class="size-4 absolute top-3 start-3"></i>
                                            </span>
                                            <input type="text"
                                                class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent ps-12"
                                                placeholder="min" name="minsalary" value="<?php echo isset($job_data['salary_min']) ? $job_data['salary_min'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-6 col-span-12 text-start">
                                    <label class="font-semibold">Max Salary:</label>

                                    <div class="md:col-span-3 col-span-12 text-start">
                                        <div class="relative mt-1">
                                            <span
                                                class="size-10 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-800 absolute top-0 start-0 overflow-hidden rounded">
                                                <i data-feather="dollar-sign" class="size-4 absolute top-3 start-3"></i>
                                            </span>
                                            <input type="text"
                                                class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent ps-12"
                                                placeholder="max" name="maxsalary" value="<?php echo isset($job_data['salary_max']) ? $job_data['salary_max'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mt-8">
                                <h5 class="text-lg font-semibold">Skill & Experience:</h5>
                            </div>

                            <div class="grid grid-cols-12 gap-4 mt-4">
                                <div class="col-span-12 text-start">
                                    <label class="font-semibold" for="Skillname">Skills:</label>
                                    <input id="Skillname" type="text" name="skills"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1"
                                        placeholder="React, PHP, Laravel , etc..." value="<?php echo isset($job_data['skills']) ? $job_data['skills'] : ''; ?>">
                                </div>

                                <div class="md:col-span-6 col-span-12 text-start">
                                    <label class="font-semibold" for="Qualification">Qualifications:</label>
                                    <input id="Qualification" type="text" name="qualification"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1"
                                        placeholder="Qualifications" value="<?php echo isset($job_data['qualification']) ? $job_data['qualification'] : ''; ?>">
                                </div>

                                <div class="md:col-span-6 col-span-12 text-start">
                                    <label class="font-semibold" for="Experience">Experience:</label>
                                    <input id="Experience" type="text" name="experience"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1"
                                        placeholder="Experience" value="<?php echo isset($job_data['experience']) ? $job_data['experience'] : ''; ?>">
                                </div>


                            </div>


                            <div class="grid grid-cols-12 gap-4 mt-4">
                                <div class="col-span-12 text-start">
                                    <label class="font-semibold" for="Address">Address:</label>
                                    <input id="Address" type="text" name="address"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-1"
                                        placeholder="Address" value="<?php echo isset($job_data['location']) ? $job_data['location'] : ''; ?>">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 mt-4">
                                <div>
                                    <button type="submit" id="submit" name="post_job"
                                        class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white">Post
                                        Now</button>
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
    <?php @include("../footer.php"); ?>
    <!-- End Footer -->

    <!-- Switcher -->



    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top"
        class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-emerald-600 text-white justify-center items-center"><i
            class="uil uil-arrow-up"></i></a>
    <!-- Back to top -->



    <script>
        $('#summernote').summernote({
            placeholder: 'Job description',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>




    <!-- JAVASCRIPTS -->
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/plugins.init.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- JAVASCRIPTS -->
</body>

</html>