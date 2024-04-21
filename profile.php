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

    $bio = isset($fields['Bio']) ? html_entity_decode($fields['Bio']) : '';
    $interests = isset($fields['Interests']) ? $fields['Interests'] : '';
    $status = isset($fields['Status']) ? $fields['Status'] : '';
    $age = isset($fields['Age']) ? $fields['Age'] : '';
    $favorite_movie = isset($fields['Favourite movie']) ? $fields['Favourite movie'] : '';
    $favorite_tv = isset($fields['Favourite TV Show']) ? $fields['Favourite TV Show'] : '';
    $favorite_music = isset($fields['Favourite Music']) ? $fields['Favourite Music'] : '';
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
    <form action="update_process.php" method="post" enctype="multipart/form-data">
        <label>About me:</label>
        <textarea name="bio"><?php echo $bio; ?></textarea><br><br>
        <label>Interests:</label>
        <textarea name="interests"><?php echo $interests; ?></textarea><br><br>
        <label>Status:</label>
        <input type="text" maxlength="200" name="status" value="<?php echo htmlspecialchars($status); ?>"><br><br>
        <label>Age:</label>
        <input type="text" name="age" value="<?php echo htmlspecialchars($age); ?>"><br><br>
        <label>Favorite movie:</label>
        <textarea name="favorite_movie"><?php echo htmlspecialchars($favorite_movie); ?></textarea><br><br>
        <label>Favourite TV Show:</label>
        <textarea name="favorite_tv"><?php echo htmlspecialchars($favorite_tv); ?></textarea><br><br>
        <label>Favourite Music:</label>
        <textarea name="favorite_music"><?php echo htmlspecialchars($favorite_music); ?></textarea><br><br>
        <input type="submit" value="Update Profile"><br><hr><br>
    </form>
</body>
</html>
