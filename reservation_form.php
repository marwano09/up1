<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('pic-rev/hikmapic.jpeg'); /* Specify the path to your background image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reservation-container {
            background-color: rgba(255, 255, 255, 0.8); /* Adding transparency to the form container */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px; /* Adjust the width as needed */
            text-align: center; /* Center the form within the container */
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .terms {
            font-size: 12px;
            text-align: center;
        }

        .terms a {
            color: #007bff;
            text-decoration: underline;
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="reservation-container">
    <div class="logo">
        <img src="pic-rev/logohikma.jpg" alt="Logo">
    </div>
    <h2>Reservation Form</h2>
    <form action="reservation_process.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>

        <label for="reason">Reason for Appointment:</label>
        <textarea id="reason" name="reason" rows="4" required></textarea>

        <input type="submit" value="Submit"><br><br>

        <div class="terms">
            By submitting this form, you agree to our <a href="terms.php">Terms and Conditions</a>.
        </div>
    </form>
</div>

</body>
</html>
