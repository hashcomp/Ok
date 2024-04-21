<?php
	session_start();

	// Check if user is logged in
	if (!isset($_SESSION['username'])) {
		header('Location: log.php');
		exit;
	}

	$username = $_SESSION['username'];

	// Check if friend username is set in URL parameter
	if (isset($_GET['username'])) {
		// Get friend's username from URL parameter
		$friend_username = $_GET['username'];
		// Load current friend list
		$friend_list_file = fopen("$username's.txt", 'a+');
		$friend_list = file("$username's.txt", FILE_IGNORE_NEW_LINES);
		// Check if friend already exists in friend list
		if (in_array($friend_username, $friend_list)) {
			$error_msg = "You are already friends with $friend_username.";
		} else {
			// Add friend to friend list
			fwrite($friend_list_file, "$friend_username\n");
			$success_msg = "$friend_username has been added to your friend list.";
		}
		fclose($friend_list_file);

		// Redirect user back to search page
		header('Location: friendadd.php');
		exit;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<style>body {font-family: Arial;}</style>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>Add Friends</title>
	<meta name='apple-mobile-web-app-capable' content='yes' />
	<link rel='apple-touch-icon' sizes='305x305' href='icon.png'>
	<link rel='icon' href='favicon.ico' type='image/x-icon'/>
	<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/>
</head>
<body>
	<h1>Add Friend</h1>
	<hr>
	<?php
		if (isset($error_msg)) {
			echo "<p style='color: red;'>$error_msg</p>";
		} else if (isset($success_msg)) {
			echo "<p style='color: green;'>$success_msg</p>";
		}
	?>
	<form method="post">
		<label>Friend's Username:</label>
		<input type="text" name="friend_username"><br><br>
		<input type="submit" value="Add Friend">
	</form>
</body>
</html>
