<?php
// This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
        $err = "Please enter username and password";
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }

    if (empty($err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        // Try to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        // this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        // Redirect user to welcome page
                        header("location: welcome.php");
                        exit;
                    }
                }
            }
        }
        $err = "Invalid username/password";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="favicon-16x16.png">
    <!-- <link rel="icon" type="image/x-icon" href="favicon-32x32.png"> -->
    <title>Login Now!</title>
    <style>
        .navbar-custom {
            background-color: white;
        }

        .footer {
            background-color: #ffffff;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            color: #090907;
        }

        .container p {
            font-weight: bold;
        }

        .footer ul {
            list-style-type: none;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 0;
        }

        .footer ul li {
            margin: 0 10px;
        }

        .footer ul li a {
            color: #010101;
            text-decoration: dotted;
            font: weight 100px;;
        }

        .container {
            padding-top: 100px;
        }
    </style>
    <style>
        body {
            transition: background-color 0.9s ease;
        }

        .dark-mode {
            background-color: #333333;
            color: #000000;
        }

        .navbar-custom {
            background-color: #fdfdfd;
        }

        .navbar-custom.light-mode {
            background-color: #f8f8ef;
        }

        .footer {
            background-color: #ffffff;
            color: #090907;
            transition: background-color 0.9s ease;

        }

        .footer.dark-mode {
            background-color: #333333;
            color: #ffffff;
        }

        .card {
            background-color: #f8f9fa;
            transition: background-color 0.9s ease;

        }

        .card.dark-mode {
            background-color: #444444;
            color: #ffffff;
        }

        .text-white {
            color: #ffffff;
        }
    </style>
    <style>
        body.dark-mode {
            color: #ffffff;
        }

        body.dark-mode a {
            color: #ffffff;
        }

        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4 {
            color: #ffffff;
        }

        body.dark-mode ul,
        body.dark-mode li {
            color: #ffffff;
        }
    </style>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
            <a class="navbar-brand" href="index.html"
                style="font-family: 'Comic Sans MS', cursive;">RESUME+</a>
            <div class="ml-auto">
                <button id="modeSwitch" class="btn  btn btn-dark ">Theme</button>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <h2>Please Login Here:</h2>
        <br>
        <section>
            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username<small class="text-danger">*</small></label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password<small class="text-danger">*</small></label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Enter Password" required>
                </div>
                <p>Read <a href="terms.html">Terms & Privacy</a></p>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" onchange="toggleLoginButton()"
                        required>
                    <label class="form-check-label" for="exampleCheck1">Agree Terms & Privacy</label>
                </div>
                <button type="submit" id="loginButton" class="btn btn-success" disabled>Login</button>
                <div class="ml-auto">
                    <hr><br><br>
                    <h3>Don't have an Account?</h3>
                    <a href="register.php" class="btn btn-primary mr-2">Register now!</a> <br>
                    <p>to continue...</p>
                </div>
            </form>
        </section>
        <footer class="footer">
            <div class="container">
                <ul>
                    <li><a href="terms.html">Terms &amp; Privacy</a></li>
                    <li><a href="aboutus.html">About Us</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
                <p>&copy; 2023 RESUME+. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script>
        function toggleLoginButton() {
            var loginButton = document.getElementById("loginButton");
            var checkBox = document.getElementById("exampleCheck1");
            loginButton.disabled = !checkBox.checked;
        }
    </script>
    <script>
        var modeSwitchButton = document.getElementById('modeSwitch');
        var body = document.querySelector('body');
        var navbar = document.querySelector('.navbar-custom');
        var footer = document.querySelector('.footer');
        var card = document.querySelector('.card');

        modeSwitchButton.addEventListener('click', function () {
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                navbar.classList.remove('light-mode');
                footer.classList.remove('dark-mode');
                card.classList.remove('dark-mode');
                modeSwitchButton.textContent = 'Dark Mode';

                // Change text color to white
                navbar.classList.remove('text-white');
                footer.classList.remove('text-white');
                card.classList.remove('text-white');
            } else {
                body.classList.add('dark-mode');
                navbar.classList.add('light-mode');
                footer.classList.add('dark-mode');
                card.classList.add('dark-mode');
                modeSwitchButton.textContent = 'Light Mode';

                // Change text color to black
                navbar.classList.add('text-white');
                footer.classList.add('text-white');
                card.classList.add('text-white');
            }
        });
    </script>
</body>

</html>
