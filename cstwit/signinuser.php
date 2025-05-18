<?php
session_start();
require_once "conn.php"; // Secure database connection

// Redirect logged-in users to their respective dashboard
if (isset($_SESSION['username'])) {
    switch ($_SESSION['role']) {
        case 'Administrator':
            header("Location: /cstwit/pages/admin/index.php");
            break;
        case 'User':
            header("Location: /cstwit/pages/user/index.php");
            break;
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $_SESSION['entered_username'] = $username; // Store the entered username
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            unset($_SESSION['entered_username']); // Clear saved username on success
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name']; // Store full name
            $_SESSION['role'] = $user['role'];
            $_SESSION['uid'] = $user['id'];

            // Redirect users based on role
            switch ($user['role']) {
                case 'Administrator':
                    header("Location: /cstwit/pages/admin/index.php");
                    break;
                case 'User':
                    header("Location: /cstwit/pages/user/index.php");
                    break;
            }
            exit;
        } else {
            $_SESSION['invalidpassword'] = "The password you entered is incorrect. Please try again.";
            header("Location: /cstwit/signin.php");
        }
    } else {
        $_SESSION['usernotfound'] = "User not found. Please try again.";
        header("Location: /cstwit/signin.php");
    }

    $stmt->close();
    $conn->close();
}
?>