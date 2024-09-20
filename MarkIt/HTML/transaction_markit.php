<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction | MarkIt</title>
    <link rel="stylesheet" href="../CSS/transactionstyle_markit.css">
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
                <li><a href="products_markit.php"><i class="fa-solid fa-box"></i></a></li>
                <li><a href="inventory_markit.php"><i class="fa-solid fa-warehouse"></i></a></li>
                <li><a href="transaction_markit.php"><i class="fa-solid fa-right-left" style="color: #2C74B3;"></i></a></li>
                <li><a href="profile_markit.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="settings_markit.php"><i class="fa-solid fa-gear"></i></a></li>
            </ul>
        </div>
    </nav>
    <section>
        <div class="title">
            <h1>Transaction</h1>
        </div>
        <div class="tool-tab">
            <div class="tab">
                <form action="" method="GET">
                    <div class="filter tool">
                        <button type="submit" class="bn1">Filter<i class="fa-solid fa-filter"></i></button>
                        <div class="filter-inputs">
                            <input type="date" name="filterDate">
                        </div>
                    </div>
                </form>
                <div class="search tool">
                    <form id="searchTrans" action="" method="GET">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="searchTransaction" id="searchInput" placeholder="Search Transaction ID">
                    </form>
                </div>
                <div class="add tool">
                    <a class="bn3637 bn37" href="new_transaction.php">New +</a>
                </div>
            </div>
        </div>
        <div class="transaction">
            <?php include("../BACKEND/displayTransaction.php"); ?>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    </script>
</body>
</html>
