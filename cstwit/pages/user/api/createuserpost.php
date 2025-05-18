<?php
session_start();

require_once '../../../conn.php';

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Collect the form data from POST
    $content = $_POST['content'];
    $user_id = $_POST['user_id'];

    // Prepare an SQL query to insert the data into the appointments table
    $sql = "INSERT INTO posts (user_id, content, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_id, $content);

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION['postsuccess'] = "Posted Successfully";
        header("Location: /cstwit/pages/user/profile.php");
    } else {
        $_SESSION['posterror'] = "Something went wrong. Please try again.";
        header("Location: /cstwit/pages/user/profile.php");
    }
    // Close the prepared statement
    $stmt->close();
}
// Close the database connection
$conn->close();
?>