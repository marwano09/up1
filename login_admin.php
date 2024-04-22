<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('pic-rev/hikmapic.jpeg'); /* Specify the path to your background image */
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .form-container {
            width: 80%; /* Adjust this value to make the form larger or smaller */
            max-width: 500px; /* Maximum width for the form */
            background-color: rgba(255, 255, 255, 0.8); /* Adding transparency to the form container */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 40px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .error-message {
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <div class="logo-container">
            <div class="logo"><img src="pic-rev/logohikma.jpg" alt="Hikma logo"></div>
        </div>
        <h2>Admin Login panel</h2>
        <form action="login_admin_process.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <!-- Error message -->
            <?php
            if (isset($_GET["error"]) && $_GET["error"] == 1) {
                echo '<div class="error-message">Please enter the correct username and password.</div>';
            }
            ?>

            <input type="submit" value="Login">
        </form>
    </div>
</div>

</body>
</html>
