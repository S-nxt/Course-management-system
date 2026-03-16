<?php
require_once '../config/db.php';

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
	if(!preg_match('/^[a-zA-Z0-9\s]+$/', $course_code)) {
		echo 'Course code can only contain letters, numbers, and spaces.';
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

<br>
<a href="read.php">Back to Courses</a> |
<a href="../index.php">Home</a>