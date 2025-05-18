<?php
session_start();

include '../../../conn.php';
if (isset($_POST['updateusername'])) {
    $id = $_POST['update_id'];
    $username = $_POST['username'];
    $last_username_change = date("Y-m-d H:i:s");

    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['updateerror'] = "Username already exists, please choose another one";
        header('Location: /cstwit/pages/user/settings.php');
        exit();
    }

    if (!empty($id)) {
        $query = "UPDATE users SET username = '$username', last_username_change = '$last_username_change' WHERE id='$id'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['updatesuccess'] = "Username Updated Successfully";
            header('Location: /cstwit/pages/user/settings.php');
        } else {
            $_SESSION['updateerror'] = "Username Update Error";
            header('Location: /cstwit/pages/user/settings.php');
        }
    }
}
?>