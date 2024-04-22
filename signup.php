    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Sign Up</title>
    <style> body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative; /* Added position relative */
        }

        #video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            /* Remove blur filter */
        }

        .signup-container {
            background-color: rgba(255, 255, 255, 0.5); /* Add opacity to create a semi-transparent background */
            backdrop-filter: blur(10px); /* Apply blur effect to the container */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            z-index: 1; /* Ensure the form is above the blurred video */
        }

        .logo {
            width: 150px;
            height: 150px;
            overflow: hidden;
            margin: 0 auto 20px;
            border-radius: 50%;
        }

        .logo img {
            width: 100%;
            height: auto;
            display: block;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:hover,
        input[type="password"]:hover,
        input[type="email"]:hover {
            border-color: #007bff;
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
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        /* Your existing CSS styles */
    </style>
</head>
<body>
<video id="video-background" autoplay muted loop>
    <source src="pic-rev/WhatsApp Video 2024-03-25 at 00.38.55_3c591308.mp4" type="video/mp4">
</video>

<div class="signup-container">
    <h2>Client Sign Up</h2>
    <div class="logo">
        <img src="pic-rev/logohikma.jpg" alt="Your Logo">
    </div>
    <form action="signup_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Sign Up">
        <!-- Link to login page -->
        <p>Already have an account? <a href="login_client.php">Log in here</a>.</p>
    </form>
</div>

</body>
</html>
