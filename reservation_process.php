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
    // Retrieve form data and sanitize
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $time = mysqli_real_escape_string($conn, $_POST["time"]);
    $reason = mysqli_real_escape_string($conn, $_POST["reason"]);

    // Retrieve the client ID based on the username stored in the session
    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $client_id_sql = "SELECT id FROM clients WHERE username = ?";
    
    // Prepared statement for client ID retrieval
    if ($stmt = mysqli_prepare($conn, $client_id_sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $client_id = $row["id"];

            // Prepared statement for reservation insertion
            $sql = "INSERT INTO reservations (client_id, name, email, phone, date, time, reason) VALUES (?, ?, ?, ?, ?, ?, ?)";
            if ($insert_stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($insert_stmt, "issssss", $client_id, $name, $email, $phone, $date, $time, $reason);
                
                if (mysqli_stmt_execute($insert_stmt)) {
                    // Reservation successful, show alert and redirect
                    echo "<script>alert('Your reservation is complete. We will call you to confirm.')</script>";
                    echo "<script>window.location.href = 'blog.php';</script>";
                    exit;
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Error: Client ID not found.";
        }
        mysqli_stmt_close($stmt);
    }
}

// Close database connection
mysqli_close($conn);
?>
