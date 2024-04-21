<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}

$username = $_SESSION['username'];

if (isset($_POST['photo'])) {
    $dataURL = $_POST['photo'];
    $data = explode(',', $dataURL);
    $base64Data = $data[1]; // Get the base64-encoded image data

    // Create a unique filename for the photo
    $filename = uniqid() . '.png';
    $filepath = 'uploads/' . $filename;

    // Save the photo to the server
    file_put_contents($filepath, base64_decode($base64Data));

    // Add the image tag to the user's profile file
    $imageTag = "<img src='$filepath' style='height: 150px; width: 150px; object-fit: contain; margin-right: 10px;'>\n";
    $profileFilePath = $username . '.txt';
    file_put_contents($profileFilePath, $imageTag, FILE_APPEND);

    // Send a response back to the client
    echo 'success';
} else {
    echo 'error';
}
?>
