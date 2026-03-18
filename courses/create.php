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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$course_name = trim($_POST['course_name']);
	$course_code = trim($_POST['course_code']);
	$description = trim($_POST['description']);
	$credits = trim($_POST['credits']);

	if ($course_name === '' || $course_code === '' || $credits === '') {
		echo 'Course name, course code, and credits are required.';
		exit();
	}

	if(!preg_match('/^[a-zA-Z0-9\s]+$/', $course_name)) {
		echo 'Course name can only contain letters, numbers, and spaces.';
		exit();
	}
	if(!preg_match('/^[a-zA-Z]/', $course_name)) {
		echo 'Course name should start with a letter.';
		exit();
	}
	
	if(!preg_match('/^[a-zA-Z0-9\s\-]+$/', $course_code)) {
		echo 'Course code can only contain letters, numbers, spaces, and hyphens.';
		exit();
	}
	if(!is_numeric($credits) || $credits <= 0) {
		echo 'Credits must be a positive number.';
		exit();
	}

	$query = "INSERT INTO courses (course_name, course_code, description, credits)
			  VALUES ('$course_name', '$course_code', '$description', '$credits')";

	if (mysqli_query($conn, $query)) {
		header('Location: read.php');
		exit();
	} else {
		echo 'Error: ' . mysqli_error($conn);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title Here</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- CSS link -->
</head>
<body>
<h2>Add New Course</h2>

<form method="POST">
	<label>Course Name:</label><br>
	<input type="text" name="course_name" placeholder="Course Name" required><br><br>

	<label>Course Code:</label><br>
	<input type="text" name="course_code" placeholder="Course Code" required><br><br>

	<label>Description:</label><br>
	<input type="text" name="description" placeholder="Description"><br><br>

	<label>Credits:</label><br>
	<input type="number" name="credits" placeholder="Credits" required><br><br>

	<button type="submit" value="Submit">Add Course</button>
</form>

	<div class="link-box">
		<a href="read.php" class="add-btn">Back to Courses</a>
		<a href="../logout.php" class="logout-link">Logout</a>
	</div>
</body>
</html>