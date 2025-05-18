<?php
session_start();

include '../../../conn.php';
if (isset($_POST['updatepassword'])) {
    $id = $_POST['updatepassword_id'];
    $password = trim($_POST['password']); // Plaintext password input
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($id)) {
        $query = "UPDATE users SET password = '$hashed_password' WHERE id='$id'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['updatesuccess'] = "Password Updated Successfully";
            header('Location: /cstwit/pages/user/settings.php');
        } else {
            $_SESSION['updateerror'] = "Update Error. Please try again";
            header('Location: /cstwit/pages/user/settings.php');
        }
    }
}
?>