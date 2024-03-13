<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "partner_user");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}