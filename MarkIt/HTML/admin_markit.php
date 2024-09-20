<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/admin_style.css">
</head>
<body>
<nav>
        <ul>
            <li><a href="admin_markit.php">Admin Dashboard</a></li>
            <li><a href="update_profile.php">Update Profile</a></li>
        </ul>
    </nav>
<div class="container">
    <h1 class="title">Admin Dashboard</h1>
    <form class="search-form" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" id="search" name="search" placeholder="Search Users by ID or Username" required>
    </form>

    <?php
    $conn = new mysqli('localhost', 'root', '', 'dbshop');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['search'])) {
        $search_term = $_GET['search'];

        $sql = "SELECT id, username, email FROM tbl_users WHERE username LIKE ? OR id = ?";
        $stmt = $conn->prepare($sql);

        $search_username = "%{$search_term}%";

        $stmt->bind_param("si", $search_username, $search_term);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td><a href='update_profile.php?user_search=".$row["id"]."'>".$row["username"]."</a></td><td>".$row["email"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='message error'>No users found with the provided search term.</p>";
        }

        $stmt->close();
    }
        

        $sql = "SELECT userid, username, email FROM tblusers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>User Accounts</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["userid"]."</td><td><a href='update_profile.php?user_search=".$row["userid"]."'>".$row["username"]."</a></td><td>".$row["email"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='message warning'>No users found.</p>";
        }

        echo "<h2>Recent Transactions</h2>";
        $sql_transactions = "
            SELECT transId, GROUP_CONCAT(prodQty) AS totalQtys, transTime 
            FROM tbltransaction 
            GROUP BY transId 
            ORDER BY transTime DESC 
            LIMIT 10";
        $result_transactions = $conn->query($sql_transactions);
        
        if ($result_transactions->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Transaction ID</th><th>Total Quantities</th><th>Time Bought</th></tr>";
            while($row = $result_transactions->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["transId"]."</td>";
                echo "<td>".$row["totalQtys"]."</td>";
                echo "<td>".$row["transTime"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='message warning'>No recent transactions found.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
