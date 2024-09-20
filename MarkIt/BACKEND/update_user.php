<?php
include '../backend/connect_admin.php';

if(isset($_POST['id']) && isset($_POST['field']) && isset($_POST['value'])){
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    $query = "UPDATE tbl_users SET $field='$value' WHERE id='$id'";
    if(mysqli_query($conn, $query)){
        echo 'Success';
    } else {
        echo 'Error';
    }
}
?>
