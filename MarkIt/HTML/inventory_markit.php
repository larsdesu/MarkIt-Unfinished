<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory</title>
    <link rel="stylesheet" href="../CSS/inventorystyle_markit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <li><a href="inventory_markit.php"><i class="fa-solid fa-warehouse"  style="color: #2C74B3;" ></i></a></li>
                <li><a href="transaction_markit.php"><i class="fa-solid fa-right-left"></i></a></li>
                <li><a href="profile_markit.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="settings_markit.php"><i class="fa-solid fa-gear"></i></a></li>
            </ul>
        </div>
    </nav>
<div class="container">
    <h1>Product Inventory</h1>
    <div class="row">
        <form id="filterForm" action="" method="GET">
            <div class="input-group">
                <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" placeholder="Search Products">
                <select name="category_filter" id="categoryFilter">
                    <option value="">Select Categories</option>
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

                    $query = "SELECT DISTINCT category FROM tblproducts WHERE userid='$user_id'";
                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="button" id="showAllButton">Show All Products</button>
            </div>
        </form>
    </div>

    <div class="row">
        <form id="addProductForm" action="add_product.php" method="POST">
            <div class="input-group">
                <input type="text" name="name" required placeholder="Product Name">
                <input type="text" name="category" required placeholder="Category">
                <input type="number" name="price" required placeholder="Price">
                <input type="number" name="stock" required placeholder="Stock">
                <button type="submit">Add Product</button>
            </div>
        </form>
    </div>
</div>

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(array("error" => "User not logged in"));
            exit();
        }

        $user_id = $_SESSION['user_id'];

        $conn = new mysqli('localhost', 'root', '', 'dbshop');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if(isset($_GET['search']) || isset($_GET['category_filter'])){
            $search_query = "";
            $category_query = "";

            if(isset($_GET['search'])){
                $search_query = " CONCAT(id,productName,category) LIKE '%" . $_GET['search'] . "%' ";
            }

            if(isset($_GET['category_filter']) && $_GET['category_filter'] != ''){
                $category_query = " category = '" . $_GET['category_filter'] . "' ";
            }

            $filter_query = "";

            if(!empty($search_query) && !empty($category_query)){
                $filter_query = " WHERE " . $search_query . " AND " . $category_query . " AND userid='$user_id'";
            } elseif (!empty($search_query)) {
                $filter_query = " WHERE " . $search_query . " AND userid='$user_id'";
            } elseif (!empty($category_query)) {
                $filter_query = " WHERE " . $category_query . " AND userid='$user_id'";
            } else {
                $filter_query = " WHERE userid='$user_id'";
            }

            $query = "SELECT * FROM tblproducts" . $filter_query;
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                if(mysqli_num_rows($query_run) > 0){
                    foreach($query_run as $items){
                    ?>
                        <tr>
                            <td><?=$items['id']; ?></td>
                            <td><?=$items['productName']; ?></td>
                            <td><?=$items['category']; ?></td>
                            <td><input type="text" class="editable" data-id="<?=$items['id']; ?>" data-field="price" value="<?=$items['price']; ?>"></td>
                            <td><input type="text" class="editable" data-id="<?=$items['id']; ?>" data-field="stock" value="<?=$items['stock']; ?>"></td>
                            <td><button class="delete-button" data-id="<?=$items['id']; ?>">Delete</button></td>
                        </tr>
                    <?php 
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">No Record Found</td>
                    </tr>
                    <?php 
                }
            } else {
                echo "<tr><td colspan='6'>Error: " . mysqli_error($conn) . "</td></tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<script>
document.getElementById('categoryFilter').addEventListener('change', function() {

    document.querySelector('input[name=search]').value = '';
    
    document.getElementById('filterForm').submit();
    
    setTimeout(function() {
        window.location.reload();
    }, 500); 
});

document.getElementById('showAllButton').addEventListener('click', function() {
    document.querySelector('input[name=search]').value = '';
    document.getElementById('categoryFilter').selectedIndex = 0;
    document.getElementById('filterForm').submit();
});

document.querySelectorAll('.editable').forEach(function(element) {
    element.addEventListener('blur', function() {
        var id = this.getAttribute('data-id');
        var field = this.getAttribute('data-field');
        var value = this.value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../BACKEND/update_inventory.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id + '&field=' + field + '&value=' + value);
    });
});

document.querySelectorAll('.delete-button').forEach(function(button) {
    button.addEventListener('click', function() {
        var id = this.getAttribute('data-id');

        if(confirm('Are you sure you want to delete this product?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../BACKEND/delete_product.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('id=' + id);
            
            xhr.onload = function() {
                if(xhr.responseText === 'Success') {
                    location.reload();
                } else {
                    alert('Error deleting product');
                }
            };
        }
    });
});
</script>

</body>
</html>
