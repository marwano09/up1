<?php
session_start();

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "hospital_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]); // Consider encrypting this before storing
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    // Prepare SQL statement to insert data into the clients table
    $sql = "INSERT INTO clients (username, password, email) VALUES ('$username', '$password', '$email')";

    if (mysqli_query($conn, $sql)) {
        // Sign up successful, show success message with animation, then redirect
        echo "<script>
                alert('Sign up successful!');
                window.location.href='login_client.php';
              </script>";
    } else {
        // If there's an error, display the error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
