<?php
require '../../../conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = (int)$_POST['post_id'];
    $user_id = (int)$_POST['user_id'];
    $reason = trim($_POST['reason']);

    if ($post_id && $user_id && $reason !== '') {
        $stmt = $conn->prepare("INSERT INTO reports (post_id, user_id, reason, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $post_id, $user_id, $reason);
        $stmt->execute();
        $_SESSION['postsuccess'] = "Report submitted. Thank you!";
    } else {
        $_SESSION['posterror'] = "Please provide a reason for reporting.";
    }
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>