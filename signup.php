<?php
include('db.php');  // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - OLX</title>
    <style>
        /* Ensure full screen */
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            overflow: hidden;
            position: relative;
        }

        /* Full-screen background image */
        #background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Place the image in the background */
        }

        /* Form container */
        .form-container {
            background-color: rgba(0, 0, 0, 0.7); /* Dark background with opacity */
            color: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 450px; /* Restrict max width */
            text-align: center;
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        label {
            font-size: 18px;
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background-color: #f8f8f8;
            color: #333;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(255, 102, 0, 0.8);
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 16px;
            background-color: #ff6600;
            color: white;
            font-size: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input[type="submit"]:hover {
            background-color: #e65c00;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-container a {
            display: inline-block;
            margin-top: 15px;
            color: #ff6600;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .form-container a:hover {
            text-decoration: underline;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .form-container {
                padding: 30px;
            }

            h1 {
                font-size: 30px;
            }

            input[type="submit"] {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <!-- Full-screen background image -->
    <img id="background" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUW3C_xYqXUT0EDtPyQlSaMAoSZ27mAo3OUA&s" alt="OLX Pakistan">

    <!-- Sign Up Form -->
    <div class="form-container">
        <h1>Create an Account</h1>
        <form action="signup.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <input href="login.php" type="submit" value="Sign Up">
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>
