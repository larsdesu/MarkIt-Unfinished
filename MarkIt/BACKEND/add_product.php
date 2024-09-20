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

if(isset($_POST['productName']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['stock'])){
    $name = $_POST['productName'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = "INSERT INTO tblproducts (productName, category, price, stock, userid) VALUES ('$name', '$category', '$price', '$stock', '$user_id')";
    if(mysqli_query($conn, $query)){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
