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

$user_query = "SELECT userid, username, email, password FROM tblusers WHERE userid='$user_id'";
$user_result = $conn->query($user_query);
if ($user_result) {
    $user = $user_result->fetch_assoc();
    if (!$user) {
        echo "No user found.";
        exit();
    }
} else {
    echo "Error: " . $conn->error;
    exit();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_password_query = "UPDATE tblusers SET password='$hashed_new_password' WHERE userid='$user_id'";
                if ($conn->query($update_password_query) === TRUE) {
                    $message = "Password changed successfully!";
                } else {
                    $message = "Error: " . $conn->error;
                }
            } else {
                $message = "New passwords do not match!";
            }
        } else {
            $message = "Current password is incorrect!";
        }
    }

    if (isset($_POST['change_email'])) {
        $new_email = $_POST['new_email'];
        $update_email_query = "UPDATE tblusers SET email='$new_email' WHERE userid='$user_id'";
        if ($conn->query($update_email_query) === TRUE) {
            $user['email'] = $new_email;
            $message = "Email changed successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }

    if (isset($_POST['change_username'])) {
        $new_username = $_POST['new_username'];
        $update_username_query = "UPDATE tblusers SET username='$new_username' WHERE userid='$user_id'";
        if ($conn->query($update_username_query) === TRUE) {
            $user['username'] = $new_username;
            $message = "Username changed successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

$total_products_query = "SELECT COUNT(*) AS total_products FROM tblproducts WHERE userid='$user_id'";
$total_products_result = $conn->query($total_products_query);
if ($total_products_result) {
    $total_products = $total_products_result->fetch_assoc()['total_products'];
} else {
    echo "Error: " . $conn->error;
    exit();
}

$total_transactions_query = "
    SELECT COUNT(*) AS total_transactions 
    FROM (
        SELECT id, SUM(totalPrice) AS total_combined_price 
        FROM tbltransaction 
        WHERE userid='$user_id'
        GROUP BY transID
    ) AS combined_transactions
";
$total_transactions_result = $conn->query($total_transactions_query);
if ($total_transactions_result) {
    $total_transactions = $total_transactions_result->fetch_assoc()['total_transactions'];
} else {
    echo "Error: " . $conn->error;
    exit();
}

$total_sales_query = "SELECT SUM(totalPrice) AS total_sales FROM tbltransaction WHERE userid='$user_id'";
$total_sales_result = $conn->query($total_sales_query);
if ($total_sales_result) {
    $total_sales = $total_sales_result->fetch_assoc()['total_sales'];
} else {
    echo "Error: " . $conn->error;
    exit();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../CSS/profilestyle_markit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<nav>
    <div class="markit-logo">
        <a href="#">MarkIT</a>
    </div>
    <div class="navs">
        <ul>
            <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="products_markit.php"><i class="fa-solid fa-box"></i></a></li>
            <li><a href="inventory_markit.php"><i class="fa-solid fa-warehouse"></i></a></li>
            <li><a href="transaction_markit.php"><i class="fa-solid fa-right-left"></i></a></li>
            <li><a href="profile_markit.php"><i style="color: #2C74B3;" class="fa-solid fa-user"></i></a></li>
            <li><a href="settings_markit.php"><i class="fa-solid fa-gear"></i></a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <h1>Account Information</h1>
    <div class="profile-details">
        <p><strong>ID:</strong> <span>#<?= htmlspecialchars($user['userid']); ?></span></p>
        <p><strong>Username:</strong> <span><?= htmlspecialchars($user['username']); ?></span> <button id="changeUsernameBtn">Edit</button></p>
        <p><strong>Email:</strong> <span><?= htmlspecialchars($user['email']); ?></span> <button id="changeEmailBtn">Edit</button></p>
        <div class="change-password">
        <button id="changePasswordBtn">Change Password</button>
    </div>
    </div>
    <div class="dashboard-details">
        <div class="detail">
            <h2>Total Sales</h2>
            <p>₱ <?= number_format($total_sales, 2); ?></p>
        </div>
        <div class="detail">
            <h2>Total Products</h2>
            <p><?= $total_products; ?></p>
        </div>
        <div class="detail">
            <h2>Total Transactions</h2>
            <p><?= $total_transactions; ?></p>
        </div>
    </div>
    <div class="log-out">
        <button class="bn3637 bn37" id="logoutButton"><i class="fa-solid fa-right-from-bracket"></i> Log Out</button>
    </div>
</div>

<div id="passwordModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form method="POST" action="">
        <p><?= $message; ?></p>
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <button type="submit" name="change_password">Change Password</button>
    </form>
  </div>
</div>

<div id="emailModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form method="POST" action="">
        <p><?= $message; ?></p>
        <label for="new_email">New Email:</label>
        <input type="email" id="new_email" name="new_email" required>
        <button type="submit" name="change_email">Change Email</button>
    </form>
  </div>
</div>

<div id="usernameModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form method="POST" action="">
        <p><?= $message; ?></p>
        <label for="new_username">New Username:</label>
        <input type="text" id="new_username" name="new_username" required>
        <button type="submit" name="change_username">Change Username</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
var passwordModal = document.getElementById("passwordModal");
var emailModal = document.getElementById("emailModal");
var usernameModal = document.getElementById("usernameModal");

var passwordBtn = document.getElementById("changePasswordBtn");
var emailBtn = document.getElementById("changeEmailBtn");
var usernameBtn = document.getElementById("changeUsernameBtn");

var spans = document.getElementsByClassName("close");

passwordBtn.onclick = function() {
  passwordModal.style.display = "block";
}

emailBtn.onclick = function() {
  emailModal.style.display = "block";
}

usernameBtn.onclick = function() {
  usernameModal.style.display = "block";
}

for (var i = 0; i < spans.length; i++) {
    spans[i].onclick = function() {
        passwordModal.style.display = "none";
        emailModal.style.display = "none";
        usernameModal.style.display = "none";
    }
}

window.onclick = function(event) {
  if (event.target == passwordModal) {
    passwordModal.style.display = "none";
  } else if (event.target == emailModal) {
    emailModal.style.display = "none";
  } else if (event.target == usernameModal) {
    usernameModal.style.display = "none";
  }
}

        $(document).ready(function() {
            $('#logoutButton').click(function() {
                Swal.fire({
                    title: 'Do you want to logout?',
                    text: "Your session will be dismiss.",
                    icon: 'warning',
                    confirmButtonText: 'Yes',
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login_markit.php';
                    }
                });
            });
        });
</script>

</body>
</html>
