<?php
session_start();
require_once '../../../conn.php';

if (!isset($_SESSION['uid'])) {
    header("Location: cstwit/signin.php");
    exit;
}

$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];
$comment = $_POST['comment'];

// Insert comment
$stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iis", $post_id, $user_id, $comment);
$stmt->execute();

// Redirect back to the post page to see the new comment
header("Location: /cstwit/pages/user/index.php");
exit;
