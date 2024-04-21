<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}
$username = $_SESSION['username'];
$emailAddress = $username . '@friendnet';

// Function to send an email
function sendEmail($from, $to, $subject, $message, $photo) {
    $folder = "mail/$to";
    if (!is_dir($folder)) {
        mkdir($folder);
    }

    $timestamp = time();
    $filename = "$folder/$timestamp.txt";
    
    // Move the uploaded photo to the recipient's folder if it exists
    if ($photo['error'] === UPLOAD_ERR_OK) {
        $photoName = $photo['name'];
        $photoTmpName = $photo['tmp_name'];
        $photoPath = "$folder/$photoName";
        move_uploaded_file($photoTmpName, $photoPath);
        $emailContent = "From: $from\nTo: $to\nSubject: $subject\n\n$message\n\n<img src=\"$photoPath\" alt=\"Photo\">";
    } else {
        $emailContent = "From: $from\nTo: $to\nSubject: $subject\n\n$message";
    }

    file_put_contents($filename, $emailContent);

    // Save a copy of the sent email
    $sentFolder = "sent/$from";
    if (!is_dir($sentFolder)) {
        mkdir($sentFolder);
    }
    $sentFilename = "$sentFolder/$timestamp.txt";
    file_put_contents($sentFilename, $emailContent);

    return true;
}

// Example usage
if (isset($_POST['submit'])) {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $photo = $_FILES['photo'];

    // Check if the 'forward' parameter is set
    if (isset($_GET['forward'])) {
        $forwardMessage = $_GET['forward'];
    } else {
        $forwardMessage = '';
    }

    if (sendEmail($emailAddress, $to, $subject, $message, $photo)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email.";
    }
} else {
    $to = isset($_GET['address']) ? $_GET['address'] : '';

    // Check if the 'forward' parameter is set
    if (isset($_GET['forward'])) {
        $forwardMessage = $_GET['forward'];
    } else {
        $forwardMessage = '';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>friendnet - Compose Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="526x526" href="icon.png">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }
</style>
<body>
<h2>Compose Mail ⭐️New Send images!!</h2>
<a href="mail.php">back</a>
<form method="POST" action="" enctype="multipart/form-data">
    <label for="to">To:</label>
    <input type="email" name="to" value="<?php echo $to; ?>" required><br><br>

    <label for="subject">Subject:</label>
    <input type="text" name="subject" required><br><br>

    <label for="message">Message:</label><br>
    <textarea name="message"><?php echo $forwardMessage; ?></textarea><br><br>

    <label for="photo">Photo:</label>
    <input type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png, .gif"><br><br>
  
  <input type="submit" name="submit" value="Send Mail">
</form>
</body>
</html>
