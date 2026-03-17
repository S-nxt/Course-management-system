<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title Here</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- CSS link -->
</head>
<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['role'])) {
	header('Location: ../index.php');
	exit();
}

if ($_SESSION['role'] !== 'admin') {
	header('Location: read.php');
	exit();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$query = "DELETE FROM courses WHERE id = $id";

if ($id > 0 && mysqli_query($conn, $query)) {
	$count_query = "SELECT COUNT(*) AS total FROM courses";
	$count_result = mysqli_query($conn, $count_query);
	$count_row = $count_result ? mysqli_fetch_assoc($count_result) : null;

	if ($count_row && (int) $count_row['total'] === 0) {
		mysqli_query($conn, "ALTER TABLE courses AUTO_INCREMENT = 1");
	}

	header('Location: read.php');
	exit();
} else {
	echo 'Error: ' . mysqli_error($conn);
}
?>
</body>
</html>