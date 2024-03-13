<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $partner_id = $_POST['partner_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $registerError = "Passwords do not match.";
    } else {
       
        $insertQuery = "INSERT INTO partner (partner_id, firstname, middlename, lastname, email, contact_number, password) VALUES ('$partner_id', '$firstname', '$middlename', '$lastname', '$email', '$contact_number', '$password')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if (!$insertResult) {
            die("Registration failed: " . mysqli_error($conn));
        }

        header("Location: login.php?registered=true");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Registration Form</title>
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
            <li style="float:right"><a class="active" href="login.php">Login</a></li>
            <li style="float:right"><a class="active" href="index.php">Home</a></li>
        </ul>
    </div>
    
    <div class="form-container">
        <h2 class="form-heading">New Partner Registration</h2>
        <form action="register.php" method="POST" autocomplete="off">
        
            <label for="partner_id">Partner Number</label>
            <input type="text" id="partner_id" name="partner_id" required value><br>
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" required value=""><br>
            
            <label for="middlename">Middle Name</label>
            <input type="text" id="middlename" name="middlename" required value><br>
            
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required value><br>
            <!-- marvin cabutaje -->
            
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required value><br>
            
            <label for="contact_number">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" required value><br>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required value><br>
            
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required value><br>
            
            <input type="submit"  name="submit"value="Register">
            <p>Already a Partner. <a href="login.php">Log in here!</a></p>
      <div class=" panel-footer text-right">
                <small>&reg;   A22C0305 </small> 
        </div>
        </form>
    </div>
</body>
</html>




