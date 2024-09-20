<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../HTML/login_markit.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'dbshop');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $sql = "SELECT productName, productImage, price, stock, category FROM tblproducts WHERE userid = ? AND productName LIKE ?";
    $search = '%' . $search . '%';
} elseif (isset($_GET['category']) && $_GET['category'] !== '') {
    $categoryFilter = $_GET['category'];
    $sql = "SELECT productName, productImage, price, stock, category FROM tblproducts WHERE userid = ? AND category = ?";
} else {
    $sql = "SELECT productName, productImage, price, stock, category FROM tblproducts WHERE userid = ?";
}

$stmt = $conn->prepare($sql);

if (!empty($search)) {
    $stmt->bind_param("is", $user_id, $search);
} elseif (isset($_GET['category']) && $_GET['category'] !== '') {
    $stmt->bind_param("is", $user_id, $categoryFilter);
} else {
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    echo "Error executing SQL query: " . $conn->error;
} else {
    $totalRows = $result->num_rows;
    $itemsPerPage = 30;
    $totalPages = ceil($totalRows / $itemsPerPage);
    $start = ($current_page - 1) * $itemsPerPage;
    $sql .= " LIMIT ?, ?";
    
    $stmt = $conn->prepare($sql);

    if (!empty($search)) {
        $stmt->bind_param("isii", $user_id, $search, $start, $itemsPerPage);
    } elseif (isset($_GET['category']) && $_GET['category'] !== '') {
        $stmt->bind_param("isii", $user_id, $categoryFilter, $start, $itemsPerPage);
    } else {
        $stmt->bind_param("iii", $user_id, $start, $itemsPerPage);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($count % 5 == 0) {
                echo "<div class='product-wrap'>";
            }
            echo '
            <div class="product-container">
                <div class="products">
                    <div class="prod-img">
                        <img src="../MarkITFiles/' . $row["productImage"] . '" alt="' . $row["productName"] . '">
                    </div>
                    <div class="prod-desc">
                        <h1>' . $row["productName"] . '</h1>
                        <h2>₱' . $row["price"] . '</h2>
                        <h6>Stock: ' . $row["stock"] . '</h6>
                    </div>
                </div>
            </div>';
            $count++;
            if ($count % 5 == 0) {
                echo "</div>";
            }
        }
        if ($count % 5 != 0) {
            echo "</div>";
        }
    } else {
        echo "<div class='no-products'>No products found.</div>";
    }

    if ($totalPages > 1) {
        echo "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            $class = ($i == $current_page) ? 'current-page' : '';
            echo "<a href='?page=$i' class='$class'>" . $i . "</a>";
        }
        echo "</div>";
    }
}
$stmt->close();
$conn->close();
?>
