<?php
session_start();

require_once 'conn.php';

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    $_SESSION['usernotfound'] = "You must login first.";
    header("Location: /cstwit/signin.php"); // Redirect to login
    exit;
}

// Check user role
function checkRole($allowed_roles)
{
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        $_SESSION['usernotfound'] = "You are not allowed to login";
        header("Location: /cstwit/signin.php");
        exit;
    }
}
function getUsername()
{
    return isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
}
// Function to get the full name of the logged-in user
function getFullname()
{
    return isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest User';
}
function getRole()
{
    return isset($_SESSION['role']) ? $_SESSION['role'] : 'Guest Role';
}
function userID()
{
    return isset($_SESSION['uid']) ? $_SESSION['uid'] : 'Guest ID';
}
?>