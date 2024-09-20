<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="../CSS/update_user_style.css">
</head>
<body>
<nav>
        <ul>
            <li><a href="admin_markit.php">Admin Dashboard</a></li>
            <li><a href="update_profile.php">Update Profile</a></li>
        </ul>
    </nav>
<div class="container">
    <h1>User Management</h1>
    <div class="row">
        <form id="userFilterForm" action="" method="GET">
            <div class="input-group">
                <input type="text" name="user_search" required value="<?php if(isset($_GET['user_search'])){echo $_GET['user_search'];} ?>" placeholder="Search by ID or Username">
                <button type="submit">Search</button>
            </div>
        </form>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $conn = new mysqli('localhost', 'root', '', 'dbshop');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if(isset($_GET['user_search'])){
                    $user_search = $_GET['user_search'];
                    $query = "";

                    if(is_numeric($user_search)) {
                        $query = "SELECT * FROM tblusers WHERE userid LIKE '%$user_search%'";
                    } else {
                        $query = "SELECT * FROM tblusers WHERE username LIKE '%$user_search%'";
                    }

                    $query_run = mysqli_query($conn, $query);
                    
                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $user){
                        ?>
                            <tr>
                                <td><?=$user['userid']; ?></td>
                                <td><input type="text" class="editable" data-id="<?=$user['userid']; ?>" data-field="username" value="<?=$user['username']; ?>"></td>
                                <td><input type="text" class="editable" data-id="<?=$user['userid']; ?>" data-field="email" value="<?=$user['email']; ?>"></td>
                                <td>
                                    <button class="delete-button" data-id="<?=$user['userid']; ?>">Delete</button>
                                </td>
                            </tr>
                        <?php 
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No Record Found</td>
                        </tr>
                        <?php 
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.querySelectorAll('.editable').forEach(function(element) {
        element.addEventListener('blur', function() {
            var id = this.getAttribute('data-id');
            var field = this.getAttribute('data-field');
            var value = this.value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../BACKEND/update_user.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('id=' + id + '&field=' + field + '&value=' + value);
        });
    });

    document.querySelectorAll('.delete-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');

            if(confirm('Are you sure you want to delete this user?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../BACKEND/delete_user.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + id);
                
                xhr.onload = function() {
                    if(xhr.responseText === 'Success') {
                        location.reload();
                    } else {
                        alert('Error deleting user');
                    }
                };
            }
        });
    });
</script>

</body>
</html>
