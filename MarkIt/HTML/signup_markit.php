<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:wght@500&family=Slabo+27px&display=swap" rel="stylesheet" />
    <title>MarkIt</title>
    <link rel="stylesheet" href="../CSS/signupstyle_markit.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <nav>
        <div class="markit-logo">
            <a href="#">MarkIT</a>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container">
            <header>
                <div class="interface">
                    <div class="intro">
                        <h2 class="markit">MARKIT <br />SALES TRACKER</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                            enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat
                            nulla pariatur.
                        </p>
                    </div>
                    <div class="register-container">
                        <h2>Sign up</h2>
                        <form action="../BACKEND/register.php" method="POST">
                            <div class="input-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" required class="required-field" />

                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required class="required-field" />

                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required class="required-field" />

                                <label for="confirm_password">Retype Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" required class="required-field" />

                                <p style="color: white">
                                    <a href="forgot.html" class="password">Forgot Password?</a>
                                </p>

                                <div class="button-container">
                                    <a href="login_markit.php" class="sign-up">Already Have an Account?</a>
                                    <div class="separator"></div>
                                    <button type="submit" class="button">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </header>
        </div>
    </div>
    <!-- JavaScript code to show SweetAlert if there's an error or success -->
    <script>
        <?php
        session_start();
        if (isset($_SESSION['error_message'])) {
            echo "Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '" . $_SESSION['error_message'] . "'
            });";
            unset($_SESSION['error_message']);
        }

        if (isset($_SESSION['success_message'])) {
            echo "Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '" . $_SESSION['success_message'] . "'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login_markit.php';
                }
            });";
            unset($_SESSION['success_message']);
        }
        ?>
    </script>
</body>
</html>
