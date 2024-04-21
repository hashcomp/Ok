<?php
	session_start();
	// Get form data
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Check if user exists and password is correct
	$users_file = fopen('users.txt', 'r');
	while (!feof($users_file)) {
		$line = fgets($users_file);
		$line_arr = explode('|', $line);
		if ($line_arr[0] == $username && rtrim($line_arr[1]) == $password) {
			$_SESSION['username'] = $username;
			header('Location: index.php');
			exit;
		}
	}
	fclose($users_file);

	// Redirect to login page with error message
	header('Location: log.php?error=1');
?>
