<?php
$conn = new mysqli('localhost', 'root', '', 'dbshop');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $query = "DELETE FROM tblproducts WHERE id='$id'";
    if(mysqli_query($conn, $query)){
        echo 'Success';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
