<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('pic-rev/bullding.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: white;
        }

        #dashboardOptions {
            margin: 20px auto;
            display: block;
            width: 200px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dashboard-info {
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }

        .delete-button:active {
            background-color: #b71c1c;
        }
    </style>
</head>
<body>

<h1>Admin Dashboard</h1>

<!-- Select dropdown to choose options -->
<select id="dashboardOptions" onchange="showDashboardInfo()">
    <option value="info">Info Client</option>
    <option value="contact">Contact Client</option>
    <option value="total">Total Reservations</option>
</select>

<!-- Container to display dashboard information -->
<div id="dashboardInfo" class="dashboard-info">
    <!-- Initial content to be replaced -->
    Select an option from the dropdown to view information.
</div>

<!-- PHP script for deleting reservations -->
<?php
// Check if the reservation_id parameter is set and not empty
if(isset($_POST['reservation_id']) && !empty($_POST['reservation_id'])) {
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "hospital_db");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve reservation ID from the POST data
    $reservation_id = $_POST['reservation_id'];

    // Prepare SQL statement to delete the reservation
    $sql = "DELETE FROM reservations WHERE id = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reservation_id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Deletion successful
        echo "<script>alert('Reservation deleted successfully.');</script>";
    } else {
        // If there's an error, display the error message
        echo "<script>alert('Error deleting reservation: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();

    // Close database connection
    mysqli_close($conn);
}
?>
<!-- End of PHP script -->

<!-- JavaScript to handle displaying dashboard information -->
<script>
    function showDashboardInfo() {
        var option = document.getElementById("dashboardOptions").value;
        var dashboardInfo = document.getElementById("dashboardInfo");

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "get_reservations.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    dashboardInfo.innerHTML = xhr.responseText;
                } else {
                    console.error("Error fetching data: " + xhr.status);
                }
            }
        };
        xhr.send("option=" + option);
    }

    // Function to handle reservation deletion
    function deleteReservation(reservationId) {
        if (confirm("Are you sure you want to delete this reservation?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_reservation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update the dashboard with the latest information after deletion
                        showDashboardInfo();
                    } else {
                        console.error("Error deleting reservation: " + xhr.responseText);
                    }
                }
            };
            xhr.send("reservation_id=" + encodeURIComponent(reservationId));
        }
    }
</script>

</body>
</html>
