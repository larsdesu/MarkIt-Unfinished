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

$searchedID = isset($_GET['searchTransaction']) ? $_GET['searchTransaction'] : '';
$filterDate = isset($_GET['filterDate']) ? $_GET['filterDate'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$offset = ($page - 1) * $perPage;

$countQuery = "SELECT COUNT(DISTINCT transID) AS totalTransactions FROM tbltransaction WHERE userid = '$user_id'";
if (!empty($searchedID)) {
    $countQuery .= " AND transID = '$searchedID'";
} elseif (!empty($filterDate)) {
    $countQuery .= " AND transDate = '$filterDate'";
}
$countResult = $conn->query($countQuery);
$totalTransactions = $countResult->fetch_assoc()['totalTransactions'];
$totalPages = ceil($totalTransactions / $perPage);

$query = "SELECT transID, SUM(prodQty) AS totalItems, totalPrice, transDate, transTime 
          FROM tbltransaction 
          WHERE userid = '$user_id'";

if (!empty($searchedID)) {
    $query .= " AND transID = '$searchedID'";
} elseif (!empty($filterDate)) {
    $query .= " AND transDate = '$filterDate'";
}

$query .= " GROUP BY transID ORDER BY transDate DESC, transTime DESC LIMIT $perPage OFFSET $offset";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transID = $row["transID"];
        $totalItems = $row["totalItems"];
        $totalPrice = $row["totalPrice"];
        $transDate = $row["transDate"];
        $transTime = $row["transTime"];

        echo "<div class='transaction-content' id='transaction-$transID'>
                <div class='transaction-info'>
                    <div class='tran-id'>
                        <h2>Transaction ID</h2>
                        <h4>#$transID</h4>
                     </div>
                <div class='transaction-item'>
                    <h2>Items</h2>
                    <h1>$totalItems</h1>
                </div>
                <div class='transaction-price'>
                    <h2>Total Price</h2>
                    <h1>₱$totalPrice</h1>
                </div>
            </div>
            <div class='transaction-details'>
                <div class='transaction-date'>
                    <h6>$transDate</h6>
                    <h6>$transTime</h6>
                </div>
                <div class='transaction-view'>
                    <h6> </h6>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<div class='notfound'>No transactions found.</div>";
}

if ($totalPages > 1) {
    echo '<div class="pagination2">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a class="trans-pagination';
        if ($i == $page) {
            echo ' current';
        }
        echo '" href="?page=' . $i;
        if (!empty($searchedID)) {
            echo '&searchTransaction=' . $searchedID;
        }
        if (!empty($filterDate)) {
            echo '&filterDate=' . $filterDate;
        }
        echo '">' . $i . '</a> ';
    }
    echo '</div>';
}

$conn->close();
?>
