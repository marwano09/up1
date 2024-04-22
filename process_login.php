<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    // Your database connection code
    // Assuming you have already established a database connection

    // Perform SQL query to check if the credentials are valid
    $sql = "SELECT * FROM clients WHERE username = '$entered_username' AND password = '$entered_password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // If credentials are valid, start a session and store the username
        $_SESSION["username"] = $entered_username;
        header("Location: confirmation_page.php");
        exit();
    } else {
        // If credentials are not valid, display an error message
        echo "Invalid username or password.";
    }
}
?>
