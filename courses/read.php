<?php
require_once '../config/db.php';

$result = mysqli_query($conn, 'SELECT * FROM courses');
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
		<th>Actions</th>
	</tr>

	<?php while ($row = mysqli_fetch_assoc($result)) { ?>
	<tr>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $row['course_name']; ?></td>
		<td><?php echo $row['course_code']; ?></td>
		<td><?php echo $row['description']; ?></td>
		<td><?php echo $row['credits']; ?></td>
		<td>
			<a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> |
			<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
		</td>
	</tr>
	<?php } ?>
</table>

<br>
<a href="create.php">Add New Course</a> |
<a href="../index.php">Home</a>
</body>
</html>