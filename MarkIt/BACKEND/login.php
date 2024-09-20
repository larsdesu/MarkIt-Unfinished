<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {

            $conn = new mysqli('localhost', 'root', '', 'dbshop');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("SELECT * FROM tblusers WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['userid'];
                    $_SESSION['username'] = $user['username'];
                    echo json_encode(array("status" => "success"));
                    exit();
                } else {
                    echo json_encode(array("status" => "error", "message" => "Invalid username or password"));
                    exit();
                }
            } else {
                echo json_encode(array("status" => "error", "message" => "User does not exist"));
                exit();
            }

            $stmt->close();
            $conn->close();
        } else {
            echo json_encode(array("status" => "error", "message" => "Username and password are required"));
            exit();
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Username and password are required"));
        exit();
    }
}
?>
