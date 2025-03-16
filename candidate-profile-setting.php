<?php
@include 'ipHandler.php';
include('header.php');


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
<section class="relative lg:mt-24 mt-[74px] pb-16">
    <div class="container mt-16">
        <div class="grid lg:grid-cols-12 grid-cols-1 gap-[30px]">
            <div class="lg:col-span-12">
                <div class="p-6 rounded-md shadow-sm dark:shadow-gray-800 bg-white dark:bg-slate-900">
                    <h5 class="text-lg font-semibold mb-4">Personal Detail :</h5>
                    <form method="POST" enctype="multipart/form-data" action="updateUserProfile.php">
                        <input type="hidden" value="<?= $_SESSION['user_id']; ?>" name="id" />
                        <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-4">
                            <div class="lg:col-span-6">
                                <label class="form-label font-medium">Your Name : <span
                                        class="text-red-600">*</span></label>
                                <input type="text" value="<?= $row['user_name'] ?? ''; ?>"
                                    class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-2"
                                    placeholder="FYour Name:" id="firstname" name="name" required="">
                            </div>

                            <div class="lg:col-span-6">
                                <label class="form-label font-medium">Your Email : <span
                                        class="text-red-600">*</span></label>
                                <input type="email" value="<?= $row['email'] ?? ''; ?>"
                                    class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-2"
                                    placeholder="Email" readonly>
                            </div>


                            <div class="lg:col-span-6">
                                <label class="form-label font-medium">Mobile Number<span
                                        class="text-red-600">*</span></label>
                                <input type="number" value="<?= $row['mobile_no'] ?? ''; ?>"
                                    class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-2"
                                    placeholder="Mobile No." name="number" required="">
                                <label class="form-label" style="color:gray; font-size: 12px;">Used for interview
                                    communication</label>

                            </div>

                            <div class="lg:col-span-6">
                                <label class="form-label font-medium">Github URL</label>
                                <input type="text" value="<?= $row['githubUrl'] ?? ''; ?>"
                                    class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-2"
                                    placeholder="https://github.com/yourusername..." id="githubUrl" name="githubUrl">
                                <label class="form-label" style="color:gray; font-size: 12px;">Optional, but
                                    recommended!</label>

                            </div>


                            <div class="lg:col-span-6">
                                <label class="form-label font-medium" for="multiple_files">Upload Resume:</label>
                                <input
                                    class="relative w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent file:h-10 file:-mx-3 file:-my-2 file:cursor-pointer file:rounded-none file:border-0 file:px-3 file:text-neutral-700 bg-clip-padding px-3 py-1.5 file:me-3 mt-2"
                                    id="multiple_files" type="file" name="cv">
                            </div>
                        </div>

                        <input type="submit" id="submit" name="send"
                            class="py-1 px-5 inline-block font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center bg-emerald-600 hover:bg-emerald-700 text-white rounded-md mt-5"
                            value="Save Changes">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div style="width: 100%; background: #ddd; border-radius: 5px; margin-top: 10px;">
    <div id="progressBar" style="width: 0%; height: 10px; background: green; border-radius: 5px;display: none;"></div>
</div>
<p id="progressText" style="text-align: center; font-size: 12px; color: gray;display: none;">0% Uploading...</p>


<?php include("footer.php"); ?>



<!-- Back to top -->
<a href="#" onclick="topFunction()" id="back-to-top"
    class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-emerald-600 text-white justify-center items-center"><i
        class="uil uil-arrow-up"></i></a>
<!-- Back to top -->

<!-- JAVASCRIPTS -->
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/plugins.init.js"></script>
<script src="assets/js/app.js"></script>

<script>
    document.querySelector("form").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let progressBar = document.getElementById("progressBar");
        let progressText = document.getElementById("progressText");

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "updateUserProfile.php", true);

        xhr.upload.onprogress = function (event) {
            if (event.lengthComputable) {
                progressBar.style.display='block';
                progressText.style.display='block';

                let percentComplete = Math.round((event.loaded / event.total) * 50);
                progressBar.style.width = percentComplete + "%";
                progressText.innerText = percentComplete + "% Uploading...";
            }
        };

        xhr.onload = function () {
            if (xhr.status == 200) {
                let percentComplete = 100;
                progressBar.style.width = percentComplete + "%";
                progressText.innerText = "100% Processing...";

                setTimeout(() => {
                    window.location.href = "candidate-profile.php";
                }, 1500);
            }
        };

        xhr.send(formData);
    });
</script>

</body>

</html>