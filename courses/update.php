<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title Here</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- CSS link -->
</head>
<body>
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

$result = mysqli_query($conn, "SELECT * FROM courses WHERE id = $id");
$course = mysqli_fetch_assoc($result);

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

	$query = "UPDATE courses SET
				course_name = '$course_name',
				course_code = '$course_code',
				description = '$description',
				credits = '$credits'
			  WHERE id = $id";

	if (mysqli_query($conn, $query)) {
		header('Location: read.php');
		exit();
	} else {
		echo 'Error: ' . mysqli_error($conn);
	}
}
?>

<h2>Edit Course</h2>

<form method="POST">
	<label>Course Name:</label><br>
	<input type="text" name="course_name" value="<?php echo htmlspecialchars($course['course_name']); ?>" required><br><br>

	<label>Course Code:</label><br>
	<input type="text" name="course_code" value="<?php echo htmlspecialchars($course['course_code']); ?>" required><br><br>

	<label>Description:</label><br>
	<input type="text" name="description" value="<?php echo htmlspecialchars($course['description']); ?>"><br><br>

	<label>Credits:</label><br>
	<input type="number" name="credits" value="<?php echo htmlspecialchars($course['credits']); ?>" required><br><br>

	<button type="submit">Update Course</button>
</form>

<br>
<a href="read.php">Back to Courses</a> |
<a href="../logout.php">Logout</a>
</body>
</html>