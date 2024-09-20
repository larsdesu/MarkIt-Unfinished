<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(array("error" => "User not logged in"));
    exit();
}

$user_id = $_SESSION['user_id'];

$conn = new mysqli('localhost', 'root', '', 'dbshop');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['id']) && isset($_POST['field']) && isset($_POST['value'])){
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    $query = "UPDATE tblproducts SET $field='$value' WHERE id='$id' AND userid='$user_id'";
    if(mysqli_query($conn, $query)){
        echo 'Success';
    } else {
        echo 'Error';
    }
}
?>
