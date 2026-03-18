<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['role'])) {
	header('Location: ../index.php');
	exit();
}

$result = mysqli_query($conn, 'SELECT * FROM courses');
$isAdmin = $_SESSION['role'] === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title Here</title>
    <link rel="stylesheet" href="../css/style.css"> 
</head>
<body>
<div class="courses-layout">
	<aside class="left-links">
		<h3>Courses Links</h3>
		<p>-For BSc.CSIT</p>
		<a href="https://bsccsitnepal.com/semesters/first-semester" target="_blank">First semester</a>
		<a href="https://bsccsitnepal.com/semesters/second-semester" target="_blank">Second semester</a>
		<a href="https://bsccsitnepal.com/semesters/third-semester" target="_blank">Third semester</a>
		<a href="https://bsccsitnepal.com/semesters/fourth-semester" target="_blank">Fourth semester</a>
		<a href="https://bsccsitnepal.com/semesters/fifth-semester" target="_blank">Fifth semester</a>
		<a href="https://bsccsitnepal.com/semesters/sixth-semester" target="_blank">Sixth semester</a>
		<a href="https://bsccsitnepal.com/semesters/seventh-semester" target="_blank">Seventh semester</a>
		<a href="https://bsccsitnepal.com/semesters/eighth-semester" target="_blank">Eighth semester</a>
	</aside>

	<div class="container courses-container">
		<div class="courses-header">
			<h2>All Courses</h2>
			<div class="top-actions">
			<?php if ($isAdmin) { ?>
			<a href="create.php" class="add-btn">Add New Course</a>
			<?php } ?>
			<a href="../logout.php" class="logout-link">Logout</a>
			</div>
		</div>

		<table border="1">
		<tr>
			<th>ID</th>
			<th>Course Name</th>
			<th>Course Code</th>
			<th>Description</th>
			<th>Credits</th>
			<?php if ($isAdmin) { ?>
			<th>Actions</th>
			<?php } ?>
		</tr>

		<?php while ($row = mysqli_fetch_assoc($result)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['course_name']; ?></td>
			<td><?php echo $row['course_code']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['credits']; ?></td>
			<?php if ($isAdmin) { ?>
			<td>
				<a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> |
				<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
			</td>
			<?php } ?>
		</tr>
		<?php } ?>
		</table>
	</div>
</div>
</body>
</html>