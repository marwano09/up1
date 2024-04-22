<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the provided username and password match the admin credentials
    if ($username === "admin" && $password === "admin123") {
        // If credentials are valid, start a session
        $_SESSION["admin"] = $username;
        header("Location: dashboard_admin.php");
        exit();
    } else {
        // If credentials are not valid, redirect back to the login page with an error message
        header("Location: login_admin.php?error=1");
        exit();
    }
}
?>

