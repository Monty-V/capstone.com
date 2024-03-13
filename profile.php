<?php
require_once('config.php');


if (!isset($_SESSION['partner_id'])) {
    header("Location: login.php");
    exit;
}

$partner_id = $_SESSION['partner_id'];

$query = "SELECT * FROM partner WHERE partner_id = '$partner_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

if ($row) {
    $firstname = $row['firstname'];
    $middlename = $row['middlename'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $contact_number = $row['contact_number'];
    
} else {
    die("User not found.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $updatedFirstname = $_POST['firstname'];
    $updatedMiddlename = $_POST['middlename'];
    $updatedLastname = $_POST['lastname'];
    $updatedEmail = $_POST['email'];
    $updatedContactNumber = $_POST['contact_number'];
 
    $updateQuery = "UPDATE partner_user SET firstname = '$updatedFirstname', middlename = '$updatedMiddlename', lastname = '$updatedLastname', email = '$updatedEmail', contact_number = '$updatedContactNumber' WHERE partner_id = '$partner_id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if (!$updateResult) {
        die("Update failed: " . mysqli_error($conn));
    }

   
    header("Location: profile.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-image: url("images/bk.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

.form-container {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  background-color: black;
  color: green;
}

.form-heading {
  text-align: center;
  color: green;
}

.profile-info-box {
  background-color: green;
  padding: 20px;
  border: 1px solid black;
  border-radius: 5px;
  margin-top: 20px;
}

.profile-info p {
  margin: 0;
  padding: 5px 0;
  color: black;
  text-align: center;
}

.profile-info strong {
  font-weight: bold;
  display: block;
  text-align: center;
}

    </style>
</head>
<body>
    <div class="menu-container">
        <ul class="menu">
            <img src="images/logo.png" style="width:150px;height:42px;">
            <li style="float:right"><a class="active" href="logout.php">Logout</a></li>
            <li style="float:right"><a class="active" href="home.php">Home</a></li>
            <li style="float:right"><a class="active" href="edit.php">Edit Profile</a></li>
        </ul>
    </div>

    <div class="form-container">
    <h2 class="form-heading">Profile</h2>
    <div class="profile-info-box">
        <div class="profile-info">
            <p><strong>Full name:</strong> <?php echo $firstname; ?> <?php echo $middlename; ?> <?php echo $lastname; ?> </p>
            
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Contact Number:</strong> <?php echo $contact_number; ?></p>
            <!-- Add more user data here -->
        </div>
    </div>
</div>
    <div class="panel-footer text-right">
        <small>&reg; A22C0305 </small>
    </div>
</body>
</html>