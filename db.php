<?php
// Database configuration
$host = 'localhost';   // Database host
$username = 'root';    // Database username
$password = '';        // Database password (empty for local setup)
$dbname = 'olx'; // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to UTF-8 for proper encoding
$conn->set_charset("utf8");
?>
