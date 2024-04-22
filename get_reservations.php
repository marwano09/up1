<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "hospital_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the selected option
if(isset($_POST['option'])) {
    $option = $_POST['option'];
    
    // Fetch reservations based on the selected option
    if($option === 'info') {
        $sql = "SELECT id, name, phone, reason FROM reservations"; // Adjusted column name
    } elseif($option === 'contact') {
        $sql = "SELECT id, name, phone, email FROM reservations"; // Adjusted column name
    } elseif($option === 'total') {
        // Fetch total reservations by date, time, and client name
        $sql = "SELECT date, time, name, COUNT(*) AS total_reservations FROM reservations GROUP BY date, time, name";
        
        // Fetch total reservations in the last 30 days
        $totalLast30DaysQuery = "SELECT COUNT(*) AS total_last_30_days FROM reservations WHERE date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
        $totalLast30DaysResult = mysqli_query($conn, $totalLast30DaysQuery);
        $row = mysqli_fetch_assoc($totalLast30DaysResult);
        $totalLast30Days = $row['total_last_30_days'];
    } else {
        die("Invalid option");
    }
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if($option === 'total') {
            echo "<h3>Total Reservations by Date, Time, and Client Name</h3>";
            echo "<table>";
            echo "<tr><th>Date</th><th>Time</th><th>Client Name</th><th>Total Reservations</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["time"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["total_reservations"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // Check if there are reservations before calculating the percentage
            if(mysqli_num_rows($result) > 0) {
                // Calculate percentage of reservations in the last 30 days
                $percentageLast30Days = ($totalLast30Days / mysqli_num_rows($result)) * 100;
                echo "<div class='percentage-table'>";
                echo "<table>";
                echo "<tr><th colspan='2'>Percentage of reservations in the last 30 days</th></tr>";
                echo "<tr><td>Total Reservations</td><td>" . mysqli_num_rows($result) . "</td></tr>";
                echo "<tr><td>Total Reservations in Last 30 Days</td><td>" . $totalLast30Days . "</td></tr>";
                echo "<tr><td>Percentage</td><td>" . round($percentageLast30Days, 2) . "%</td></tr>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p>No reservations found.</p>";
            }
        } else {
            // Display reservations in a table
            echo "<h3>Reservations</h3>";
            echo "<table>";
            echo "<tr><th>Reservation ID</th><th>Name</th><th>Phone Number</th>";
            
            // Display additional columns based on the selected option
            if($option === 'info') {
                echo "<th>Reason</th>";
            } elseif($option === 'contact') {
                echo "<th>Email</th>";
            }
            
            echo "<th>Action</th></tr>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                
                // Display additional columns based on the selected option
                if($option === 'info') {
                    echo "<td>" . $row["reason"] . "</td>";
                } elseif($option === 'contact') {
                    echo "<td>" . $row["email"] . "</td>";
                }
                
                echo "<td><button onclick=\"deleteReservation(" . $row["id"] . ")\">Delete</button></td>";
                echo "</tr>";
            }
            
            echo "</table>";
        }
    } else {
        echo "Error fetching data: " . mysqli_error($conn);
    }
} else {
    echo "Option not provided";
}

mysqli_close($conn);
?>
