<?php
require_once('config.php');

if (isset($_SESSION['partner_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $partner_id = $_POST['partner_id'];
    $password = $_POST['password'];

   
    $query = "SELECT * FROM partner WHERE partner_id = '$partner_id' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
       
        $_SESSION['partner_id'] = $partner_id;
        header("Location: home.php");
        exit;
    } else {
       
        header("Location: login.php?login=failed");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-image: url("images/bk.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <ul class="menu">
            <img src="images/logo.png" style="width:150px;height:42px;">
            <li style="float:right"><a class="active" href="register.php">Register</a></li>
            <li style="float:right"><a class="active" href="index.php">Home</a></li>
        </ul>
    </div>

    <div class="form-container">
        <h2 class="form-heading">Login</h2>
        <form action="login.php" method="POST" autocomplete="off">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <label for="partner_id">Partner Number</label>
                <input type="partner_id" id="partner_id" name="partner_id" required><br>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required><br>
            </div>

            <input type="submit" name="submit" value="Login">
            <p>Not a partner yet? <a href="register.php">Register here!</a></p>
            <div class="panel-footer text-right">
                <img src="images/try.jpg" position="center"; style="width:300px; height:150px;"><br><br>
                <small>&reg;   A22C0305 </small>
            </div>
        </form>
    </div>
</body>
</html>