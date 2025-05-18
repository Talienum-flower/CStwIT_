<?php
session_start();

include '../../../conn.php';
if (isset($_POST['updatename'])) {
    $id = $_POST['update_id'];
    $name = $_POST['name'];

    if (!empty($id)) {
        $query = "UPDATE users SET name = '$name' WHERE id='$id'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['updatesuccess'] = "User Updated Successfully";
            header('Location: /cstwit/pages/user/settings.php');
        } else {
            $_SESSION['updateerror'] = "User Update Error";
            header('Location: /cstwit/pages/user/settings.php');
        }
    }
}
?>