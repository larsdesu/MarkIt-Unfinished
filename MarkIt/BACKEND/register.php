<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'dbshop');
if ($conn->connect_error) {
    $_SESSION['error_message'] = "Connection failed: " . $conn->connect_error;
    header("Location: ../HTML/signup_markit.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = "Passwords do not match.";
        header("Location: ../HTML/signup_markit.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = $conn->prepare("INSERT INTO tblusers (username, email, password) VALUES (?, ?, ?)");
    if ($sql) {
        $sql->bind_param("sss", $username, $email, $hashed_password);
        if ($sql->execute()) {
            $_SESSION['success_message'] = "Registration successful!";
            header("Location: ../HTML/signup_markit.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Error: " . $sql->error;
            header("Location: ../HTML/signup_markit.php");
            exit();
        }
        $sql->close();
    } else {
        $_SESSION['error_message'] = "Error preparing the SQL statement: " . $conn->error;
        header("Location: ../HTML/signup_markit.php");
        exit();
    }
    $conn->close();
}
?>
