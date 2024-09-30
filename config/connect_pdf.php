<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "e-donation";
$con = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Set charset to utf8
mysqli_set_charset($con, "utf8");
