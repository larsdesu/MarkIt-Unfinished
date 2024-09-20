<?php
include '../backend/connect_admin.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $query = "DELETE FROM tbl_users WHERE id='$id'";
    if(mysqli_query($conn, $query)){
        echo 'Success';
    } else {
        echo 'Error';
    }
}
?>
