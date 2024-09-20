<?php
$conn = new mysqli('localhost', 'root', '', 'dbshop');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}
$user_id = $_SESSION['user_id'];

$todayDate = date('Y-m-d');

if (isset($_GET['filterDate']) && !empty($_GET['filterDate'])) {
    $selectedDate = $_GET['filterDate'];
    $todayDate = $selectedDate;
}

$salesQuery = "SELECT SUM(prodPrice * prodQty) AS totalSales 
               FROM tbltransaction 
               WHERE DATE(transDate) = '$todayDate' AND userid = '$user_id'";
$salesResult = $conn->query($salesQuery);
$totalSalesRow = $salesResult->fetch_assoc();
$totalSales = $totalSalesRow['totalSales'] ?? 0; 

$itemsSoldQuery = "SELECT SUM(prodQty) AS totalItemsSold 
                   FROM tbltransaction 
                   WHERE DATE(transDate) = '$todayDate' AND userid = '$user_id'";
$itemsSoldResult = $conn->query($itemsSoldQuery);
$totalItemsSoldRow = $itemsSoldResult->fetch_assoc();
$totalItemsSold = $totalItemsSoldRow['totalItemsSold'] ?? 0; 

$lowStockQuery = "SELECT COUNT(*) AS lowStockItems 
                  FROM tblproducts 
                  WHERE stock < 10 AND userid = '$user_id'";
$lowStockResult = $conn->query($lowStockQuery);
$lowStockItemsRow = $lowStockResult->fetch_assoc();
$lowStockItems = $lowStockItemsRow['lowStockItems'] ?? 0; 

$conn->close();
?>

<div class="date-indicator">Showing data for 
    <?php 
    echo ($todayDate == date('Y-m-d')) ? 'today, ' . $todayDate : $todayDate; 
    ?>
</div>

<div class="box-content">
    <div class="boxes">
        <div class="box box1">
            <i class="uil uil-file-upload-alt"></i>
            <span class="text">Sales</span>
            <a href="../HTML/transaction_markit.php" class="number"><h1><?php echo $totalSales; ?></h1></a>
            <p>Pesos</p>
        </div>
        <div class="box box2">
            <i class="uil uil-comments"></i>
            <span class="text">Items Sold</span>
            <a href="../HTML/transaction_markit.php" class="number"><h1><?php echo $totalItemsSold; ?></h1></a>
            <p>Pieces</p>
        </div>
        <div class="box box3">
            <i class="uil uil-bag"></i>
            <span class="text">Low Stock</span>
            <a href="../HTML/inventory_markit.php" class="number"><h1><?php echo $lowStockItems; ?></h1></a>
            <p>Items</p>
        </div>
    </div>
</div>
