    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to OLX Pakistan</title>
        <style>
            body, html {
                height: 100%;
                margin: 0;
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f4f4f4;
                overflow: hidden;
            }

            .container {
                position: absolute;
                text-align: center;
                color: white;
                z-index: 10; /* Ensure the buttons are above the image */
            }

            #logo {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover; /* Ensure the image covers the full page */
                z-index: -1; /* Make sure the image is in the background */
            }

            h1 {
                font-size: 50px;
                font-weight: bold;
                text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Add shadow for better visibility */
                margin-bottom: 20px;
            }

            .buttons {
                margin-top: 20px;
            }

            .btn {
                background-color: #ff6600;
                color: white;
                font-size: 18px;
                padding: 15px 30px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                margin: 10px;
                display: inline-block;
            }

            .btn:hover {
                background-color: #e65c00;
            }

            /* Additional mobile responsiveness */
            @media (max-width: 768px) {
                h1 {
                    font-size: 36px; /* Smaller font size on mobile */
                }

                .btn {
                    padding: 12px 25px;
                    font-size: 16px;
                }
            }
        </style>
    </head>
    <body>

        <!-- Full-screen OLX image -->
        <img id="logo" src="https://i.brecorder.com/wp-content/uploads/2017/04/OLX-Pakistan.jpg" alt="OLX Pakistan">

        <!-- Centered content with buttons -->
        <div class="container">
            <h1>Welcome to OLX Pakistan</h1>
            <div class="buttons">
                <a href="login.php" class="btn">Login</a>
                <a href="signup.php" class="btn">Sign Up</a>
            </div>
        </div>

    </body>
    </html>
