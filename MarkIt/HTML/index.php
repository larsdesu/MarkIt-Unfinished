<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | MarkIt</title>
    <link rel="stylesheet" href="../CSS/homestyle_markit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <nav>
        <div class="markit-logo">
            <a href="#">MarkIT</a>
        </div>
        <div class="navs">
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-house" style="color: #2C74B3;"></i></a></li>
                <li><a href="products_markit.php"><i class="fa-solid fa-box"></i></a></li>
                <li><a href="inventory_markit.php"><i class="fa-solid fa-warehouse"></i></a></li>
                <li><a href="transaction_markit.php"><i class="fa-solid fa-right-left"></i></a></li>
                <li><a href="profile_markit.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="settings_markit.php"><i class="fa-solid fa-gear"></i></a></li>
            </ul>
        </div>
    </nav>
    
    <section class="dashboard">
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <div class="shop">
                        <i class="fa-solid fa-shop"></i>
                        <span class="text">Shop</span>
                    </div>
                    <div class="filter">
                        <form action="">
                            <input type="date" name="filterDate" id="filterDate">
                            <button class="bn1">Filter <i class="fa-solid fa-filter"></i></button>
                        </form>
                    </div>
                </div>
                <?php include("../BACKEND/fetchDashboard.php") ?>
                <div class="recent-transactions">
                    <h2>Recent Transactions</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Total Price</th>
                                <th>Items</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $conn = new mysqli('localhost', 'root', '', 'dbshop');

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }

                            if (!isset($_SESSION['user_id'])) {
                                die("User not logged in.");
                            }
                            $user_id = $_SESSION['user_id'];

                            $recentTransactionsQuery = "SELECT transID, transDate, transTime, totalPrice, SUM(prodQty) AS totalQty 
                                                        FROM tbltransaction 
                                                        WHERE userid = '$user_id'
                                                        GROUP BY transID 
                                                        ORDER BY transID DESC 
                                                        LIMIT 15";
                            $recentTransactionsResult = $conn->query($recentTransactionsQuery);

                            if ($recentTransactionsResult->num_rows > 0) {
                                while ($row = $recentTransactionsResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["transID"] . "</td>";
                                    echo "<td>" . $row["transDate"] . "</td>";
                                    echo "<td>" . $row["transTime"] . "</td>";
                                    echo "<td>" . $row["totalPrice"] . "</td>";
                                    echo "<td>" . $row["totalQty"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No recent transactions found</td></tr>";
                            }

                            $conn->close();
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
    </script>
</body>
</html>
