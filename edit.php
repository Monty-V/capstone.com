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
    $password = $row['password']; 
   
} else {
    die("User not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $updatedFirstname = $_POST['firstname'];
    $updatedMiddlename = $_POST['middlename'];
    $updatedLastname = $_POST['lastname'];
    $updatedEmail = $_POST['email'];
    $updatedContactNumber = $_POST['contact_number'];
    $updatedPassword = $_POST['password']; 
    
    $updateQuery = "UPDATE partner SET firstname = '$updatedFirstname', middlename = '$updatedMiddlename', lastname = '$updatedLastname', email = '$updatedEmail', contact_number = '$updatedContactNumber', password = '$updatedPassword' WHERE partner_id = '$partner_id'";
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
    <title>Edit Profile</title>
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

        .profile-info {
            text-align: center;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <ul class="menu">
            <img src="images/logo.png" style="width:150px;height:42px;">
            <li style="float:right"><a class="active" href="logout.php">Logout</a></li>
            <li style="float:right"><a class="active" href="home.php">Dashboard</a></li>
        </ul>
    </div>
    
    <div class="form-container">
        <div class="edit-profile-form">
            <h2>Edit Profile</h2>
            <form method="POST" action="">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" value="<?php echo $firstname; ?>" required>

                <label for="middlename">Middle Name:</label>
                <input type="text" name="middlename" value="<?php echo $middlename; ?>">

                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" value="<?php echo $lastname; ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $email; ?>" required>

                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" value="<?php echo $contact_number; ?>">

                <label for="password">Password:</label>
                <input type="password" name="password" value="<?php echo $password; ?>" required>

                

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>