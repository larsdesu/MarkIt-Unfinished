<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Transaction</title>
    <link rel="stylesheet" href="../CSS/transactionstyle_markit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <section>
        <div id="myModal" class="modal">
            <div class="transaction-modal">
                <div class="transaction-area">
                    <div class="products-area">
                        <div class="trans-ttl">
                            <h1>Products</h1>  
                        </div>
                        <hr>
                        <div class="mini-tool">
                            <div class="mini-search">
                                <form action="" method="GET" onsubmit="return true;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                </form>
                            </div>
                        </div>
                        <div class="products-data">
                            <?php
                            include ("../BACKEND/displayProduct.php")
                            ?>
                        </div>
                    </div>
                    <div class="selected-products">
                        <div class="trans-ttl">
                            <h1>Item List</h1>
                        </div>
                        <div class="item-tbl">
                            <table class="listed-items">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Items</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="item-total">
                                        <td class="td-first">Total</td>
                                        <td>₱0</td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="transaction-btn">
                    <a class="cancel x" href="transaction_markit.php">Cancel</a>
                    <button class="create plus">Create</button>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>
    var selectedProducts = [];

    function addToSelectedProducts(productName, price) {
        var existingProduct = selectedProducts.find(function(product) {
            return product.name === productName;
        });

        if (existingProduct) {
            existingProduct.quantity++;
            existingProduct.totalPrice += price;
        } else {
            selectedProducts.push({
                name: productName,
                price: price,
                quantity: 1,
                totalPrice: price
            });
        }

        updateItemList();
    }

    function decreaseProductQuantity(productName) {
        var existingProduct = selectedProducts.find(function(product) {
            return product.name === productName;
        });

        if (existingProduct) {
            existingProduct.quantity--;
            existingProduct.totalPrice -= existingProduct.price;
            if (existingProduct.quantity <= 0) {
                selectedProducts = selectedProducts.filter(function(product) {
                    return product.name !== productName;
                });
            }
            updateItemList();
        }
    }

    function updateItemList() {
        var itemListTable = document.querySelector('.listed-items tbody');
        itemListTable.innerHTML = '';

        var totalItems = 0;
        var totalPrice = 0;

        selectedProducts.forEach(function(product) {
            totalItems += product.quantity;
            totalPrice += product.totalPrice;

            itemListTable.innerHTML += `
                <tr class="item-data">
                    <td>${product.name}</td>
                    <td>₱${product.price}</td>
                    <td>${product.quantity}</td>
                    <td>
                        <button onclick="decreaseProductQuantity('${product.name}')">-</button>
                        <button onclick="addToSelectedProducts('${product.name}', ${product.price})">+</button>
                    </td>
                </tr>`;
        });

        itemListTable.innerHTML += `
            <tr class="item-total">
                <td>Total</td>
                <td id='totalPrice'>₱${totalPrice}</td>
                <td id='totalItems'>${totalItems}</td>
                <td></td>
            </tr>`;
    }

    function sendTransactionData() {
        console.log("Sending transaction data...");

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../BACKEND/createTransaction.php');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
            Swal.fire({
                icon: 'success',
                title: 'Transaction Completed',
                // text: 'Transaction has been successfully completed!',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'transaction_markit.php';
                }
            });
        } else {
            console.error('Error:', xhr.statusText);
        }
        };
        xhr.onerror = function() {
            console.error('Request failed');
        };

        var transactionData = {
            products: selectedProducts,
            totalPrice: document.getElementById('totalPrice').innerText.replace('₱', ''),
            totalItems: parseInt(document.getElementById('totalItems').innerText)
        };

        console.log("Transaction data:", transactionData);

        xhr.send(JSON.stringify(transactionData));
    }

    document.addEventListener('click', function(event) {
        var product = event.target.closest('.products');
        if (product) {
            var productName = product.querySelector('h1').textContent;
            var priceString = product.querySelector('h2').textContent;
            var price = parseFloat(priceString.replace('₱', '')); 
            addToSelectedProducts(productName, price);
        }
    });

    document.querySelector('.transaction-btn button:last-child').addEventListener('click', function() {
        sendTransactionData();
    });

    $(document).ready(function(){
        $('.transaction-content').click(function(e){ 
            e.preventDefault();
            var transID = $(this).attr('id').split('-')[1]; 
            $.ajax({
                type: 'POST',
                url: '../BACKEND/displayTransaction.php',
                data: { transID: transID },
                success: function(response){
                    $('#modal-' + transID + ' .transaction-clicked').html(response);
                    $('#modal-' + transID).show();
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        });

        $('.modal-transaction').click(function(){
            $(this).hide();
        });
    });
    </script>
</body>
</html>
