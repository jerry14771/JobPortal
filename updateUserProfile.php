<?php
include('config.php');
require 'vendor/autoload.php'; // Load PDF parser library

use Smalot\PdfParser\Parser;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $name = trim($_POST["name"]);
    $number = trim($_POST["number"]);
    $githubUrl = trim($_POST["githubUrl"]) ?: NULL;

    $updateSql = "UPDATE users SET user_name = ?, mobile_no = ?, githubUrl = ? WHERE id = ?";
    $params = [$name, $number, $githubUrl, $id];
    $types = "sssi";

    if (isset($_FILES["cv"]) && $_FILES["cv"]["size"] > 0) {
        $uploadDir = "resume/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES["cv"]["name"]);
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = "resume_" . $id . "_" . time() . "." . $fileExt;
        $uploadFilePath = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES["cv"]["tmp_name"], $uploadFilePath)) {
            // Parse PDF and extract text
            $parser = new Parser();
            $pdf = $parser->parseFile($uploadFilePath);
            $resumeText = $pdf->getText();
            $updateSql = "UPDATE users SET user_name = ?, mobile_no = ?, githubUrl = ?, resumeLocation = ?, resumeSummary = ? WHERE id = ?";
            $params = [$name, $number, $githubUrl, $uploadFilePath, $resumeText, $id];
            $types = "sssssi";
        } else {
            $_SESSION['error'] = "File upload failed!";
            header("Location: candidate-profile.php");
            exit();
        }
    }

    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating profile!";
    }

    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid request!";
}

$conn->close();

header("Location: candidate-profile.php");
exit();
