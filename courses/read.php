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
    <link rel="stylesheet" href="../css/style.css"> <!-- CSS link -->
</head>
<body>
<h2>All Courses</h2>

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

<br>
<?php
if ($isAdmin) { ?>
<a href="create.php" class="add-btn">Add New Course</a> |
<?php } ?>
<a href="../logout.php" class="logout-link">Logout</a>
</body>
</html>