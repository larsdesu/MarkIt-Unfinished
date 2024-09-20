<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:wght@500&family=Slabo+27px&display=swap" rel="stylesheet" />
    <title>MarkIt</title>
    <link rel="stylesheet" href="../CSS/loginstyle_markit.css"/>
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
                            MarkIt, your partner in streamlining sales and inventory management processes 
                            with ease and efficiency. Tailored specifically for businesses, MarkIt offers 
                            a cashier-like experience, simplifying the recording of sales and eliminating 
                            the hassle of manual computations. Configurable settings enable you to tailor 
                            MarkIt to your specific requirements, making it an invaluable tool for corporate
                            administration. Whether you're a startup looking to streamline operations or 
                            an established enterprise seeking to stay ahead in a competitive market, MarkIt 
                            is here to simplify processes, boost efficiency, and drive growth for your business.
                        </p>
                    </div>

                    <div class="login-container">
                        <h2>LOG IN</h2>
                        <form action="../BACKEND/login.php" method="post"> 
                            <div class="input-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" required class="required-field" />
                            </div>
                            <div class="input-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required class="required-field" /> 
                            </div>
                            <p>
                                <a href="#" class="password">Forgot Password?</a>
                            </p>
                            <div class="button-container">
                                <a href="signup_markit.php" class="sign-up">Sign Up</a>
                                <div class="separator"></div>
                                <button type="submit" class="button">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </header>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const loginForm = document.querySelector("form[action='../BACKEND/login.php']");

        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            const formData = new FormData(loginForm);
            const response = await fetch(loginForm.getAttribute("action"), {
                method: "POST",
                body: formData
            });

            if (response.ok) {
                const result = await response.json();
                if (result.status === "success") {
                    window.location.href = "../HTML/index.php";
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again later.'
                });
            }
        });
    });
</script>

</body>
</html>