<?php

@include 'ipHandler.php';
@include "header.php";

?>

<section class="relative lg:py-24 py-16">
    <div class="container">
        <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
            <div class="lg:col-span-6 md:col-span-6">
                <div class="lg:ms-5">
                    <div class="bg-white dark:bg-slate-900 rounded-md shadow-sm dark:shadow-gray-700 p-6">
                        <h3 class="mb-6 text-xl leading-normal font-semibold">Create a Personalized Cold Email</h3>

                        <form method="post" name="myForm" id="myForm">
                            <p class="mb-0" id="error-msg"></p>
                            <div id="simple-msg"></div>
                            <div class="grid lg:grid-cols-12 lg:gap-6">
                                <div class="lg:col-span-6 mb-5">
                                    <label for="name" class="font-semibold">Full Name:</label>
                                    <input name="name" id="name" type="text"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-2 shadow-sm focus:shadow-md focus:border-emerald-500 transition-all duration-300"
                                        placeholder="Name">
                                </div>

                                <div class="lg:col-span-6 mb-5">
                                    <label for="email" class="font-semibold">Your Contact Email:</label>
                                    <input name="email" id="email" type="email"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-10 outline-none bg-transparent mt-2 shadow-sm focus:shadow-md focus:border-emerald-500 transition-all duration-300"
                                        placeholder="Email">
                                </div>
                            </div>

                            <div class="grid grid-cols-1">
                                <div class="mb-5">
                                    <label for="comments" class="font-semibold">Job Role & Requirements</label>
                                    <textarea name="comments" id="comments"
                                        class="w-full py-2 px-3 text-[14px] border border-gray-200 dark:border-gray-800 dark:bg-slate-900 dark:text-slate-200 rounded h-28 outline-none bg-transparent mt-2 shadow-sm focus:shadow-md focus:border-emerald-500 transition-all duration-300"
                                        placeholder="Describe the job role and key responsibilities here..."></textarea>
                                </div>
                            </div>

                            <button type="submit" id="submit" name="send"
                                class="py-2 px-6 inline-block font-semibold tracking-wide border align-middle transition duration-300 ease-in-out text-base text-center bg-emerald-600 hover:bg-emerald-700 text-white rounded-md shadow-md hover:shadow-lg">
                                Generate Email
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 md:col-span-6">
    <div class="lg:ms-5">
        <div class="bg-white dark:bg-gray-900 rounded-md shadow-md hover:shadow-lg dark:shadow-gray-700 p-6 relative transition-all duration-300">
            <div class="flex justify-between items-center">
                <h3 class="text-xl leading-normal font-semibold text-gray-800 dark:text-white">Generated Email</h3>
                <button id="copyBtn"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded text-sm shadow-md hover:shadow-lg transition-all duration-300">
                    Copy Email
                </button>
            </div>
            <div class="your-email mt-4 p-4 rounded bg-gray-50 dark:bg-gray-800 min-h-[100px] text-gray-700 dark:text-gray-300 overflow-auto">
                Your email will display here...
            </div>
        </div>
    </div>
</div>

        </div>
    </div>


</section>

<?php include 'footer.php'; ?>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#myForm").submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "generate_email.php",
                type: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    $("#submit").text("Generating...").prop("disabled", true);
                },
                success: function (response) {
                    $("#submit").text("Generate").prop("disabled", false);
                    $(".your-email").html(response);
                },
                error: function () {
                    alert("Something went wrong. Please try again!");
                    $("#submit").text("Generate").prop("disabled", false);
                }
            });
        });
    });
</script>

<script>
    document.getElementById("copyBtn").addEventListener("click", function () {
        let emailContent = document.querySelector(".your-email").innerText;

        if (!emailContent || emailContent.trim() === "Show here") {
            alert("No email content to copy!");
            return;
        }

        let tempTextArea = document.createElement("textarea");
        tempTextArea.value = emailContent;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        document.execCommand("copy");
        document.body.removeChild(tempTextArea);

        this.innerText = "Copied!";
        setTimeout(() => {
            this.innerText = "Copy";
        }, 2000);
    });
</script>















<!-- <script src="assets/libs/tobii/js/tobii.min.js"></script> -->
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/plugins.init.js"></script>
<script src="assets/js/app.js"></script>