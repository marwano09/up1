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
            position: relative;
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

        th,
        td {
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

        .card-container {
            border-radius: 5px;
            box-shadow: 0px 10px 20px -10px rgba(0, 0, 0, 0.75);
            color: #000;
            padding: 20px;
            position: absolute;
            top: 20px;
            left: 20px;
            width: 250px;
            max-width: 100%;
            text-align: center;
            background-color: #fff;
            /* White background */
        }

        .card-container h3,
        .card-container h6,
        .card-container p {
            color: #000;
            /* Black text */
        }

        .admin-functions ul li {
            border: 1px solid #2D2747;
            border-radius: 2px;
            display: inline-block;
            font-size: 12px;
            margin: 0 7px 7px 0;
            padding: 7px;
            color: #000;
            /* Black text */
        }

        .round {
            border-radius: 50%;
            /* Make the image circular */
            width: 150px;
            /* Set the width of the circular image */
            height: 150px;
            /* Set the height of the circular image */
            object-fit: cover;
            /* Ensure the image covers the circular area */
        }

        footer {
            display: none;
            /* Remove the footer */
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

    <!-- Profile
<!-- Profile Section -->
    <div class="card-container">
        <!-- <span class="pro">PRO</span> -->
        <img class="round" src="pic-rev/logohikma.jpg" alt="user" />
        <h3>Hello Sir Admin</h3>

        <p>admin panel for Reservation</p>
        <div class="buttons">
            <!-- <button class="primary">
            Message
        </button>
        <button class="primary ghost">
            Following
        </button> -->
        </div>
        <div class="admin-functions">
            <h6>Admin Functions</h6>
            <ul>
                <li>Remove Reservation</li>
                <li>Confirm Reservation</li>
                <li>Ask Client About Reservation</li>
            </ul>
        </div>
    </div>

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