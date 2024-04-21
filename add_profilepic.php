<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for errors in uploaded file
    if ($_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
        $error_msg = 'Error uploading file.';
    } else {
        // Get file extension
        $file_ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
        // Check if file is an image
        if (!in_array($file_ext, array('jpg', 'jpeg', 'png', 'gif'))) {
            $error_msg = 'File must be a JPG, JPEG, PNG, or GIF image.';
        } else {
            // Generate unique filename
            $filename = uniqid() . ".$file_ext";
            // Move file to profile_pics directory
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], "profile_pics/$filename");
            // Update user's profile data in the text file
            $profile_file = "$username.txt";
            if (!file_exists($profile_file)) {
                die("Profile not found.");
            }
            $profile_data = file_get_contents($profile_file);
            // Check if Profile Picture line exists
            $pattern = "/Profile Picture: (.+)/";
            if (preg_match($pattern, $profile_data, $matches)) {
                // Replace existing profile picture
                $profile_data = preg_replace($pattern, "Profile Picture: $filename", $profile_data);
            } else {
                // Add new profile picture at the top
                $profile_data = "Profile Picture: $filename\n" . $profile_data;
            }
            file_put_contents($profile_file, $profile_data);
            // Redirect to profile page
            header("Location: profile.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Upload Profile Pic</title>
    <meta name='apple-mobile-web-app-capable' content='yes' />
    <link rel='apple-touch-icon' sizes='305x305' href='icon.png'>
    <link rel='icon' href='favicon.ico' type='image/x-icon'/>
    <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/>
</head>
<body>
  <style>body {font-family: Arial;}</style>
  <h1>Upload a Profile Pic</h1>
    <?php if (isset($error_msg)) { echo "<p style='color: red;'>$error_msg</p>"; } ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label>Profile Picture:</label>
        <input type="file" name="profile_pic"><br><br>
        <input type="submit" value="Upload Profile Picture">
    </form>
</body>
</html>
