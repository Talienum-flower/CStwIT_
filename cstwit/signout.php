<?php
session_start();

// Unset all session variables
$_SESSION = [];
// Destroy the session
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>