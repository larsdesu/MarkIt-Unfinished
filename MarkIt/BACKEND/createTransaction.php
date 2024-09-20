<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(array("error" => "User not logged in"));
    exit();
}

$user_id = $_SESSION['user_id'];

$data = json_decode(file_get_contents("php://input"), true);

$conn = new mysqli('localhost', 'root', '', 'dbshop');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$maxTransIDQuery = "SELECT MAX(transID) AS maxTransID FROM tbltransaction";
$maxTransIDResult = $conn->query($maxTransIDQuery);
if ($maxTransIDResult->num_rows > 0) {
    $row = $maxTransIDResult->fetch_assoc();
    $maxTransID = $row["maxTransID"];
    $transID = $maxTransID + 1;
} else {
    $transID = 1000000001;
}

$totalPrice = $data['totalPrice'];
$totalItems = $data['totalItems'];

foreach ($data['products'] as $product) {
    $productName = $conn->real_escape_string($product['name']);
    $price = $product['price'];
    $quantity = $product['quantity'];

    $sql = "INSERT INTO tbltransaction (transID, prodName, prodPrice, prodQty, totalPrice, totalQty, userid) 
            VALUES ($transID, '$productName', $price, $quantity, $totalPrice, $totalItems, $user_id)";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
