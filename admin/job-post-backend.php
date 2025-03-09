<?php
include '../config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token!');
    }

    $logoDir = '../logo';
    if (!is_dir($logoDir)) {
        mkdir($logoDir, 0777, true);
    }
    $logoPath = '';
    if (isset($_FILES['logo_image']) && $_FILES['logo_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['logo_image']['tmp_name'];
        $fileExtension = pathinfo($_FILES['logo_image']['name'], PATHINFO_EXTENSION);
        $fileName = 'pixelapply' . time() . '.' . $fileExtension;
        $filePath = $logoDir . '/' . $fileName;
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            $logoPath = $filePath;
        } else {
            die("Error uploading the file.");
        }
    }




    if (isset($_POST['post_job']) && $_POST['edit_id'] == null) {

        $job_title = isset($_POST['job_title']) ? trim($_POST['job_title']) : null;
        $job_url = isset($_POST['job_url']) ? trim($_POST['job_url']) : null;
        $company_name = isset($_POST['company_name']) ? trim($_POST['company_name']) : null;
        $job_description = isset($_POST['job_description']) ? $_POST['job_description'] : null;
        $job_categories = isset($_POST['job_categories']) ? trim($_POST['job_categories']) : null;
        $job_type = isset($_POST['job_type']) ? trim($_POST['job_type']) : null;
        $minsalary = isset($_POST['minsalary']) ? trim($_POST['minsalary']) : null;
        $maxsalary = isset($_POST['maxsalary']) ? trim($_POST['maxsalary']) : null;
        $skills = isset($_POST['skills']) ? trim($_POST['skills']) : null;
        $qualification = isset($_POST['qualification']) ? trim($_POST['qualification']) : null;
        $experience = isset($_POST['experience']) ? trim($_POST['experience']) : null;
        $address = isset($_POST['address']) ? trim($_POST['address']) : null;
        $stmt = $conn->prepare("INSERT INTO job_post (job_url, job_title, company_name, job_description, job_categories, job_type, salary_min, salary_max, skills, qualification, experience, `location`, logo_url, `status`, date_posted) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active', NOW())");
        if ($stmt) {
            $stmt->bind_param(
                'sssssssssssss',
                $job_url,
                $job_title,
                $company_name,
                $job_description,
                $job_categories,
                $job_type,
                $minsalary,
                $maxsalary,
                $skills,
                $qualification,
                $experience,
                $address,
                $logoPath
            );


            if ($stmt->execute()) {
                header("Location: job-post.php");
            } else {
                echo 'Error: ' . $stmt->error;
                echo 'Error: ' . $conn->error;
                exit;
            }
            $stmt->close();
        } else {
            echo 'Failed to prepare the SQL statement.';
        }
    }

    // Code for deletion records
    if (isset($_POST['delete_job']) && $_POST['job_id'] != null) {
        $job_id = intval($_POST['job_id']);
        $query = "SELECT logo_url FROM job_post WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if (!empty($data['logo_url']) && file_exists($data['logo_url'])) {
            unlink($data['logo_url']);
        }

        $stmt = $conn->prepare("DELETE FROM job_post WHERE job_id = ?");
        if ($stmt) {
            $stmt->bind_param('i', $job_id);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo 'Error: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            echo 'Failed to prepare the SQL statement.';
        }
    }

    // Code to update data
    if (isset($_POST['edit_id'])) {
        $edit_id = $_POST['edit_id'];
        $company_name = isset($_POST['company_name']) ? trim($_POST['company_name']) : null;
        $job_url = isset($_POST['job_url']) ? trim($_POST['job_url']) : null;
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

        // Fetch existing logo path for update
        if ($logoPath) {
            $query = "SELECT logo_url FROM job_post WHERE job_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $edit_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $oldData = $result->fetch_assoc();
            if (!empty($oldData['logo_url']) && file_exists($oldData['logo_url'])) {
                unlink($oldData['logo_url']);
            }

            // Include logo in the update query
            $stmt = $conn->prepare("UPDATE job_post 
            SET job_title = ?, job_url = ?, company_name = ?, job_description = ?, job_categories = ?, job_type = ?, salary_min = ?, salary_max = ?, skills = ?, qualification = ?, experience = ?, `location` = ?, logo_url = ? 
            WHERE job_id = ?");

            if ($stmt) {
                $stmt->bind_param(
                    'sssssssssssssi',
                    $job_title,
                    $job_url,
                    $company_name,
                    $job_description,
                    $job_categories,
                    $job_type,
                    $minsalary,
                    $maxsalary,
                    $skills,
                    $qualification,
                    $experience,
                    $address,
                    $logoPath,
                    $edit_id
                );
            }
        } 
        else {
            $stmt = $conn->prepare("UPDATE job_post 
                SET job_title = ?, job_url = ?, company_name = ?, job_description = ?, job_categories = ?, job_type = ?, salary_min = ?, salary_max = ?, skills = ?, qualification = ?, experience = ?, `location` = ? 
                WHERE job_id = ?");

            if ($stmt) {
                $stmt->bind_param(
                    'ssssssssssssi',
                    $job_title,
                    $job_url,
                    $company_name,
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
            }
        }
        
       
        
        if ($stmt->execute()) {
        header("Location: index.php");
        exit();  // Prevent further execution
        } else {
            echo 'Error: ' . $stmt->error;
        }

    }

    if (isset($_POST['job_id'], $_POST['current_status'])) {
        $job_id = (int) $_POST['job_id'];
        $current_status = $_POST['current_status'] === 'Active' ? 'Deactive' : 'Active';

        $stmt = $conn->prepare("UPDATE job_post SET status = ? WHERE job_id = ?");
        $stmt->bind_param('si', $current_status, $job_id);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header('Location:index.php');
            exit();
        } else {
            $stmt->close();
            $conn->close();
            echo 'Error updating status';
        }
    }
}



$conn->close();
