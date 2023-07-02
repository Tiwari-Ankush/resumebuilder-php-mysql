<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Something went wrong";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

    // Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $confirm_password_err = "Passwords should match";
    }

    // If there were no errors, go ahead and insert into the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn,$sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set these parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
    }
    mysqli_close($conn);
}

// Rest of your HTML code...

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="favicon-16x16.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Register</title>
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

        .container p{
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
            text-decoration:dotted;
            font: weight 100px;;
        }
        .container {
            padding-top: 100px;
        }
        .btn-disabled {
        opacity: 0.5;
        cursor: not-allowed;
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
            <a class="navbar-brand" href="index.html" style="font-family: 'Comic Sans MS', cursive;">RESUME+</a>
            <div class="ml-auto">
                <button id="modeSwitch" class="btn  btn btn-dark ">Theme</button>
                <!-- <a href="#" class="btn btn-primary mr-2">Login</a> -->
                <a href="login.php" class="btn btn-success">Create Resume</a>
            </div>
        </nav>
    </header>

<section>

<div class="container mt-4" >
<h2>Register Here :)</h2>
<hr>
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Username<small class="text-danger">*</small></label>
      <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Email" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password<small class="text-danger">*</small></label>
      <input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Password"required>
    </div>
  </div>
  <div class="form-group">
      <label for="inputPassword4">Confirm Password<small class="text-danger">*</small></label>
      <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password"required>
    </div>
  <div class="form-group">
    <label for="inputAddress2">Address</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, Society, flat no.">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City<small class="text-danger">*</small></label>
      <input type="text" placeholder="City.." class="form-control" id="inputCity" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State<small class="text-danger">*</small></label>
      <select id="inputState" class="form-control"required>
        <option selected>Choose...</option>
        
        <option>Andaman and Nicobar Islands </option>
        <option> Andhra Pradesh</option>
        <option> Arunachal Pradesh</option>
        <option> Assam</option>
        <option> Bihar</option>
        <option> Chandigarh</option>
        <option> Chhattisgarh</option>
        <option> Dadra and Nagar Haveli and Daman and Diu</option>
        <option> Delhi</option>
        <option> Goa</option>
        <option> Gujrat</option>
        <option> Haryana</option>
        <option> Himachal Pradesh</option>
        <option> Jammu and Kashmir</option>
        <option> Jharkhand</option>
        <option> Karnataka</option>
        <option> Kerala</option>
        <option> Ladakh</option>
        <option>Lakshdweep </option>
        <option>Madhya Pradesh </option>
        <option>Maharashtra </option>
        <option>Manipur </option>
        <option>Meghalaya </option>
        <option> Mizoram</option>
        <option> Nagaland</option>
        <option> Odisha</option>
        <option> Puducherry</option>
        <option> Punjab</option>
        <option> Rajasthan</option>
        <option> Sikkim</option>
        <option> Tamil Nadu</option>
        <option> Telangana</option>
        <option> Tripura</option>
        <option> Uttar Pradesh</option>
        <option> Uttarakhand</option>
        <option>West Bengal </option>
        



      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip-code</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <p>Read <a href="terms.html">Terms & Privacy</a></p> 

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Agree Terms & Privacy
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-dark mr-5 mt-3 register-button" disabled>Register</button>



  <div class="ml-auto">
    <hr><br><br>
    <h3>Already have an account</h3>
                <a href="login.php" class="btn btn-primary mr-2 ">Login</a> <p>to continue...</p>
    </div>

</form>
</div>

</section>
<footer class="footer">
        <div class="container">
            <ul>
                <li><a href="#">Terms &amp; Privacy</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <p>&copy; 2023 RESUME+. All rights reserved.</p>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkbox = document.getElementById('gridCheck');
        var registerButton = document.querySelector('.register-button');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                registerButton.removeAttribute('disabled');
                registerButton.classList.remove('btn-disabled');
            } else {
                registerButton.setAttribute('disabled', 'disabled');
                registerButton.classList.add('btn-disabled');
            }
        });
    });
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

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
