<?php
session_start();
require '../../../conn.php'; // Your DB connection

$currentUserId = $_SESSION['uid']; // Replace this with your auth logic
$currentUsername = $_SESSION['username'];
$targetUserId = (int) $_POST['target_user_id'];
$targetUsername =  $_POST['target_user_name'];
$action = $_POST['action'];

if ($currentUserId && $targetUserId && $currentUserId !== $targetUserId) {
  if ($action === 'follow') {
    $stmt = $conn->prepare("INSERT IGNORE INTO follows (follower_id, follower_username, followed_id, followed_username) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $currentUserId, $currentUsername, $targetUserId, $targetUsername);
    $stmt->execute();
  } elseif ($action === 'unfollow') {
    $stmt = $conn->prepare("DELETE FROM follows WHERE follower_id = ? AND followed_id = ?");
    $stmt->bind_param("ii", $currentUserId, $targetUserId);
    $stmt->execute();
  }
}

// Redirect back (could be improved with AJAX)
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
