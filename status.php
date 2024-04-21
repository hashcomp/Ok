<?php
ini_set('display_errors', 0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}

$requested_username = $_SESSION['username'];
$filename = "$requested_username's.txt";

if (!file_exists($filename)) {
    $message = "$requested_username has no friends :(";
} else {
    $message = "$requested_username's friends:";
    $friend_list = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $friends = array();
    foreach ($friend_list as $friend) {
        $friend = trim($friend);
        if (!empty($friend)) {
            $friends[] = $friend;
        }
    }
    if (count($friends) == 0) {
        $message = "$requested_username has no friends :(";
    }
}

?>

<html>
<head>
  <style>body {font-family: Arial;}</style>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name='apple-mobile-web-app-capable' content='yes' />
  <link rel='apple-touch-icon' sizes='305x305' href='icon.png'>
  <link rel='icon' href='favicon.ico' type='image/x-icon'/>
  <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/>
</head>
</html>
<?php
    session_start();
    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header('Location: log.php');
        exit;
    }
    $username = $_SESSION['username'];
    // Load user profile data from the text file
    $profile_file = "$username.txt";
    if (!file_exists($profile_file)) {
        die("Profile not found.");
    }
    $profile_data = file_get_contents($profile_file);

    // Extract profile fields
    $profile_fields = explode("\n", $profile_data);
    $fields = [];

    foreach ($profile_fields as $field) {
        $field_parts = explode(': ', $field);
        if (count($field_parts) == 2) {
            $field_name = $field_parts[0];
            $field_value = $field_parts[1];
            $fields[$field_name] = $field_value;
        }
    }

    $status = isset($fields['Status']) ? $fields['Status'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <style>body {font-family: Arial;}</style>
    <title><?php echo "$username's Profile"; ?></title>
</head>
<body>
    <h1>Change Status</h1><hr>
    <?php
        // Check for update success message
        if (isset($_GET['success'])) {
            echo "<p style='color: green;'>Profile updated successfully.</p>";
        }
    ?>
    <form action="update_status.php" method="post" enctype="multipart/form-data">
        <label>Status:</label>
        <input type="text" maxlength="200" name="status" value="<?php echo htmlspecialchars($status); ?>"><br><br>
        <input type="submit" value="Update"><br><hr>
    </form>
</body>
</html>
<html>
<body>
  <h1>Friends Status</h1>
  <?php if (count($friends) > 0) { ?>
  <ul>
    <?php foreach ($friends as $friend) {
        $friend_file = "$friend.txt";
        if (file_exists($friend_file)) {
            $friend_status = '';
            $lines = file($friend_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, 'Status:') === 0) {
                    $friend_status = substr($line, 8);
                    break;
                }
            }
            ?>
            <li>
                <strong><?php echo $friend ?></strong>
                <br>
                <em>Status:</em> <?php echo $friend_status ?><hr>
            </li>
            <?php
        } else {
            ?>
            <li><?php echo $friend ?></li>
            <?php
        }
    } ?>
  </ul>
  <?php } ?>
</body>
</html>
