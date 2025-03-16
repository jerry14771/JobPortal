<?php

@include('config.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure request method is POST and file is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["cv"]) && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $uploadDir = "resume/"; // Directory to store CVs

    // Ensure the folder exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES["cv"]["name"]);
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = "resume_" . $id . "_" . time() . "." . $fileExt; // Rename file to avoid conflicts
    $uploadFilePath = $uploadDir . $newFileName;

    // Check if file was uploaded successfully
    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $uploadFilePath)) {
        // Update the database
        $updateSql = "UPDATE users SET resumeLocation = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("si", $uploadFilePath, $id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "CV uploaded successfully!";
        } else {
            $_SESSION['error'] = "Database update failed!";
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = "File upload failed!";
    }
} else {
    $_SESSION['error'] = "Invalid request!";
}

$conn->close();

// Redirect back
header("Location: index.php");
exit();
