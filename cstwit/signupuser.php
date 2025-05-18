<?php
session_start();
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // Plaintext password input

    // Store entered values in session (except password for security)
    $_SESSION['entered_name'] = $name;
    $_SESSION['entered_username'] = $username;

    // Check if the username already exists
    $check_sql = "SELECT id FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['userexists'] = "Username is already taken.";
        header("Location: /cstwit/dist/pages/signup.php");
        exit;
    }

    $check_stmt->close(); // Close the check statement

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $role = "User";

    // Prepare and bind
    $sql = "INSERT INTO users (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $username, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['registrationsuccess'] = "Registration Successfully";
        header("Location: /cstwit/signin.php");
    } else {
        $_SESSION['registrationfailed'] = "Registration Failed";
        header("Location: /cstwit/signup.php");
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>