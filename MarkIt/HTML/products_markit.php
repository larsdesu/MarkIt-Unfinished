<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | MarkIt</title>
    <link rel="stylesheet" href="../CSS/productsstyle_markit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <nav>
        <div class="markit-logo">
            <a href="#">MarkIT</a>
        </div>
        <div class="navs">
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="products_markit.php"><i class="fa-solid fa-box" style="color: #2C74B3;"></i></a></li>
                <li><a href="inventory_markit.php"><i class="fa-solid fa-warehouse"></i></a></li>
                <li><a href="transaction_markit.php"><i class="fa-solid fa-right-left"></i></a></li>
                <li><a href="profile_markit.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="settings_markit.php"><i class="fa-solid fa-gear"></i></a></li>
            </ul>
        </div>
    </nav>
    <section>
        <div class="title">
            <h1>Products</h1>
        </div>
        <div class="tool-tab">
            <div class="tab">
                
                <div class="category tool">
                    <form action="products_markit.php" method="GET" id="categoryForm">
                        <select name="category" id="category" onchange="this.form.submit()">
                            <?php
                            $conn = new mysqli('localhost', 'root', '', 'dbshop');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            
                            $category_sql = "SELECT DISTINCT category FROM tblproducts ORDER BY category ASC";
                            $category_result = $conn->query($category_sql);
                            
                            $options = '<option value="">Category</option>'; 
                            while($category_row = $category_result->fetch_assoc()) {
                                $category = $category_row["category"];
                                $selected = isset($_GET['category']) && $_GET['category'] == $category ? 'selected' : '';
                                $options .= "<option value='$category' $selected>$category</option>";
                            }
                            
                            echo $options;
                            
                            $conn->close();
                            ?>
                        </select>
                    </form>
                </div>

                <div class="search tool">
                    <form action="" method="GET">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    </form>
                </div>
            </div>
        </div>
        
        <div class="product-div" id="displayer">
            <?php 
                include("../BACKEND/displayProduct.php");
            ?>
        </div>

        
        <div id="prodModal" class="modal">
            <div class="product-modal">
                <span class="close" onclick="closeModal()">&times;</span>
                <div class="product-content">
                    <div class="product-info">
                        <h1>Add Product</h1>
                        <div class="product-inputs">
                            <form id="productForm" method="post" action="../BACKEND/addProduct.php" enctype="multipart/form-data">
                                <label for="productName">Product Name:</label><br>
                                <input type="text" id="productName" name="productName"><br>
            
                                <label for="productImage">Product Image URL:</label><br>
                                <input type="file" id="productImage" name="productImage"><br>
            
                                <label for="category">Type / Category:</label><br>
                                <input type="text" id="category" name="category"><br>

                                <label for="price">Price:</label><br>
                                <input type="number" id="price" name="price"><br>

                                <label for="stock">Stock:</label><br>
                                <input type="number" id="stock" name="stock"><br>
                                <button type="submit" value="Add Product">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="add-product">
            <button class="bn3637 bn37" onclick="openModal()">+</button>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let modal = document.getElementById("prodModal");
        function openModal() {
            modal.style.display = "block";
        }
        function closeModal() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
        function selectProduct(element) {
            element.classList.toggle('selected');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Product added successfully!',
                }).then((result) => {

                    if (result.isConfirmed) {
                        window.history.replaceState({}, document.title, window.location.pathname);
                    }
                });
            }

            if (urlParams.has('error')) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: urlParams.get('error'),
                }).then((result) => {

                    if (result.isConfirmed) {
                        window.history.replaceState({}, document.title, window.location.pathname);
                    }
                });
            }
        });
    </script>
</body>
</html>
