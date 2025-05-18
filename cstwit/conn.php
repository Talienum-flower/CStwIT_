<?php
$host = "127.0.0.1";    // Database host (e.g., 127.0.0.1 or your server IP)
$username = "root";         // Database username
$password = "";             // Database password
$dbname = "cstwit"; // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4 for better security & compatibility
$conn->set_charset("utf8mb4");
?>