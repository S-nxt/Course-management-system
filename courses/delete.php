<?php
require_once '../config/db.php';

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