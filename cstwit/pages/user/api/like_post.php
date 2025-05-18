<?php
session_start();
require '../../../conn.php';

if (!isset($_SESSION['uid'])) {
    header("Location: cstwit/signin.php");
    exit;
}

$user_id = (int) $_SESSION['uid'];
$post_id = $_POST['post_id'];


// Check if already liked
$stmt = $conn->prepare("SELECT id FROM likes WHERE user_id = ? AND post_id = ?");
$stmt->bind_param("ii", $user_id, $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Unlike
    $del = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
    $del->bind_param("ii", $user_id, $post_id);
    $del->execute();
} else {
    // Like
    $ins = $conn->prepare("INSERT INTO likes (user_id, post_id, created_at) VALUES (?, ?, NOW())");
    $ins->bind_param("ii", $user_id, $post_id);
    $ins->execute();
}

// Redirect back to feed
header("Location: /cstwit/pages/user/index.php"); // replace with your actual page
exit;