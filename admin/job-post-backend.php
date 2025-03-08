<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token!');
    }

    //  Code for post Jobs

    if (isset($_POST['post_job']) && !isset($_POST['edit_id'])) {
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

    // Code for deletion records

    if (isset($_POST['delete_job']) && isset($_POST['job_id'])) {
        $job_id = intval($_POST['job_id']);  

        $stmt = $conn->prepare("DELETE FROM job_post WHERE job_id = ?");
        if ($stmt) {
            $stmt->bind_param('i', $job_id);

            if ($stmt->execute()) {
                header("Location:index.php");
                exit();
            } else {
                echo 'Error: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            echo 'Failed to prepare the SQL statement.';
        }
    }

    // Write code to update data

  
    if (isset($_POST['edit_id'])) {
        $edit_id = $_POST['edit_id']; // Get the job ID to update
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
    
        // Check for required fields
        if (empty($job_title) || empty($job_categories) || empty($job_type)) {
            die('Please fill in all required fields.');
        }
    
        // Prepare the SQL statement for updating
        $stmt = $conn->prepare("UPDATE job_post 
                                SET job_title = ?, 
                                    job_description = ?, 
                                    job_categories = ?, 
                                    job_type = ?, 
                                    salary_min = ?, 
                                    salary_max = ?, 
                                    skills = ?, 
                                    qualification = ?, 
                                    experience = ?, 
                                    `location` = ? 
                                WHERE job_id = ?");
        if ($stmt) {
            $stmt->bind_param(
                'ssssssssssi',
                $job_title,
                $job_description,
                $job_categories,
                $job_type,
                $minsalary,
                $maxsalary,
                $skills,
                $qualification,
                $experience,
                $address,
                $edit_id
            );
    
            // Execute the statement
            if ($stmt->execute()) {
                header("Location: index.php");
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
