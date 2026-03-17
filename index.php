<?php
session_start();
require_once 'config/db.php';

if (isset($_SESSION['role'])) {
	header('Location: courses/read.php');
	exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = trim($_POST['username'] ?? '');
	$password = trim($_POST['password'] ?? '');

	if ($username === '' || $password === '') {
		$error = 'Username and password are required.';
	} else {
		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);
		$query = "SELECT id, username, role FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
		$result = mysqli_query($conn, $query);

		if ($result && mysqli_num_rows($result) === 1) {
			$user = mysqli_fetch_assoc($result);
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['role'] = $user['role'];
			header('Location: courses/read.php');
			exit();
		}

		$error = 'Invalid username or password.';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Course Management System</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<h1>Course Management System</h1>
	<h2>Login</h2>

	<?php if ($error !== '') { ?>
		<p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
	<?php } ?>

	<form method="POST">
		<label>Username:</label><br>
		<input type="text" name="username" placeholder="Enter username" required><br><br>

		<label>Password:</label><br>
		<input type="password" name="password" placeholder="Enter password" required><br><br>

		<button type="submit">Login</button>
	</form>

	<p>Login users come from the database table `users`.</p>
</body>
</html>