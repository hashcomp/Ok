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
    <h1>Edit Your Page</h1><hr>
    <?php
        // Check for update success message
        if (isset($_GET['success'])) {
            echo "<p style='color: green;'>Profile updated successfully.</p>";
        }
    ?>
    <form action="update_status.php" method="post" enctype="multipart/form-data">
        <label>Status:</label>
        <input type="text" name="status" value="<?php echo htmlspecialchars($status); ?>"><br><br>
        <input type="submit" value="Update Status"><br><hr><br>
    </form>
</body>
</html>
