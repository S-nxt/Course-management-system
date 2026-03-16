<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "course_management";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>