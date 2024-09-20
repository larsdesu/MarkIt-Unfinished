<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../HTML/login_markit.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$conn = new mysqli('localhost', 'root', '', 'dbshop');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO tblproducts (productName, productImage, category, price, stock, userid) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssdis", $productName, $productImage, $category, $price, $stock, $user_id);

$productName = $_POST['productName'];
$productImage = $_FILES['productImage']['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$stock = $_POST['stock'];

$targetDir = "../MarkITFiles/";
$targetFilePath = $targetDir . basename($_FILES["productImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        header("Location: ../HTML/products_markit.php?error=File is not an image.");
        exit();
    }
}

if (file_exists($targetFilePath)) {
    header("Location: ../HTML/products_markit.php?error=Error, please try again.");
    exit();
}
if ($_FILES["productImage"]["size"] > 500000) {
    header("Location: ../HTML/products_markit.php?error=File is too large.");
    exit();
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    header("Location: ../HTML/products_markit.php?error=Unknown file type.");
    exit();
}

if ($uploadOk == 0) {
    header("Location: ../HTML/products_markit.php?error=Sorry, the file was not uploaded.");
    exit();
} else {
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFilePath)) {

        if ($stmt->execute()) {

            header("Location: ../HTML/products_markit.php?success=true");
            exit();
        } else {
            header("Location: ../HTML/products_markit.php?error=Error: " . $conn->error);
            exit();
        }
    } else {
        header("Location: ../HTML/products_markit.php?error=Upload Error.");
        exit();
    }
}

$stmt->close();
$conn->close();
?>
