<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token!');
    }

    if (isset($_POST['post_job'])) {
        $job_title = isset($_POST['job_title']) ? trim($_POST['job_title']) : null;
        $job_description = isset($_POST['job_description']) ? $_POST['job_description'] : null; 
        $job_categories = isset($_POST['job_categories']) ? trim($_POST['job_categories']) : null;
        $job_type = isset($_POST['job_type']) ? trim($_POST['job_type']) : null;
        $minsalary = isset($_POST['minsalary']) ? trim($_POST['minsalary']) : null;
        $maxsalary = isset($_POST['maxsalary']) ? trim($_POST['maxsalary']) : null;
        $skills = isset($_POST['skills']) ? trim($_POST['skills']) : null;
        $qualification = isset($_POST['qualification']) ? trim($_POST['qualification']) : null;
        $experience = isset($_POST['experience']) ? trim($_POST['experience']) : null;
        $address = isset($_POST['address']) ? trim($_POST['address']) : null;

        if (empty($job_title) || empty($job_categories) || empty($job_type)) {
            die('Please fill in all required fields.');
        }

        $stmt = $conn->prepare("INSERT INTO job_post (job_title, job_description, job_categories, job_type, salary_min, salary_max, skills, qualification, experience, `location`, `status`, date_posted) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active', NOW())");
        if ($stmt) {
            $stmt->bind_param(
                'ssssssssss',
                $job_title,
                $job_description,
                $job_categories,
                $job_type,
                $minsalary,
                $maxsalary,
                $skills,
                $qualification,
                $experience,
                $address
            );

            // Execute the statement
            if ($stmt->execute()) {
                header("Location:job-post.php");
            } else {
                echo 'Error: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            echo 'Failed to prepare the SQL statement.';
        }
    }
}

$conn->close();
