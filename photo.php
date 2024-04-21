<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'uploads/';

    // Create the uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    $filename = $_FILES['photo']['name'];
    $tmpFilePath = $_FILES['photo']['tmp_name'];

    $destinationPath = $uploadDir . $filename;

    // Move the uploaded file to the destination path
    if (move_uploaded_file($tmpFilePath, $destinationPath)) {
        // Add the image tag to the user's profile file
        $imageTag = "<img src='$destinationPath' style='height: 150px; width: 150px; object-fit: contain; margin-right: 10px;'>\n";
        $profileFilePath = $username . '.txt';
        file_put_contents($profileFilePath, $imageTag, FILE_APPEND);

        // Send a response back to the client
        echo 'success';
        exit;
    } else {
        echo 'Error uploading the file.';
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Photo Upload</title>
</head>
<body>
    <h1>Photo Upload</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="photo">
        <input type="submit" value="Upload">
    </form>
</body>
</html>
