<?php
session_start();  // Start the session

// Remove specific session variable
unset($_SESSION['email']);

// Destroy the session completely
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
