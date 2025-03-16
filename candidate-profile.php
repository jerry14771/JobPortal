<?php
@include 'ipHandler.php';
@include "header.php";

if ($conn) {
    $id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
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

?>
<section class="relative mt-12 md:pb-24 pb-16">
    <div class="container">
        <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
            <div class="lg:col-span-4 md:col-span-5">
                <div class="bg-slate-50 dark:bg-slate-800 rounded-md shadow-sm dark:shadow-gray-700 p-6 sticky top-20"
                    style="margin-top:15px">
                    <div style="display: flex; justify-content: space-between;">
                    <h5 class="text-lg font-semibold">Personal Detail:</h5>
                    <a href="candidate-profile-setting.php" style="background: #009966; color: white; padding-left: 10px;padding-right: 10px;border-radius: 5px;">Edit</a>
                    </div>
                    <ul class="list-none mt-4">
                        <li class="flex justify-between mt-3 items-center font-medium">
                            <span><i data-feather="mail" class="size-4 text-slate-400 me-3 inline"></i><span
                                    class="text-slate-400 me-3">Name :</span></span>
                            <span><?= $row['user_name']; ?></span>
                        </li>
                        <li class="flex justify-between mt-3 items-center font-medium">
                            <span><i data-feather="gift" class="size-4 text-slate-400 me-3 inline"></i><span
                                    class="text-slate-400 me-3">Email :</span></span>

                            <span><?= $row['email']; ?></span>
                        </li>
                        <li class="flex justify-between mt-3 items-center font-medium">
                            <span><i data-feather="phone" class="size-4 text-slate-400 me-3 inline"></i><span
                                    class="text-slate-400 me-3">Mobile :</span></span>

                            <span><?= $row['mobile_no']; ?></span>
                        </li>
                        <li class="mt-3 w-full bg-white p-3 rounded-md shadow-sm dark:shadow-gray-700">
                            <div class="flex items-center mb-3">
                                <i data-feather="file-text" class="size-8 text-slate-400"></i>
                                <span class="font-medium ms-2"><?= $row['user_name']; ?>.pdf</span>
                            </div>

                            <?php
                            if (!empty($row['resumeLocation'])):
                                ?>
                                <a href="<?= $row['resumeLocation'];?>"
                                    class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center bg-emerald-600 hover:bg-emerald-700 border-emerald-600 dark:border-emerald-600 text-white rounded-md w-full"
                                    download><i class="uil uil-file-download-alt"></i> Download CV</a>

                            <?php else: ?>

                                <form method="POST" action="uploadcv.php" enctype="multipart/form-data">

                                    <input type="hidden" name="id" value="<?= $id;?>" />
                                    <input type="file" name="cv"
                                        class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center bg-gray-200 dark:bg-gray-700 border-gray-400 dark:border-gray-600 text-black dark:text-white rounded-md w-full mb-2" />

                                    <button type="submit"
                                        class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center bg-emerald-600 hover:bg-emerald-700 border-emerald-600 dark:border-emerald-600 text-white rounded-md w-full">
                                        Upload CV
                                    </button>
                                </form>
                            <?php endif; ?>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php @include('footer.php'); ?>


<a href="#" onclick="topFunction()" id="back-to-top"
    class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-emerald-600 text-white justify-center items-center"><i
        class="uil uil-arrow-up"></i></a>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/plugins.init.js"></script>
<script src="assets/js/app.js"></script>
<!-- JAVASCRIPTS -->
</body>


</html>