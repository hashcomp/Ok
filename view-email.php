<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}

$username = $_SESSION['username'];
$emailAddress = $username . '@friendnet';

// Function to retrieve the list of emails for a user
function getEmails($user) {
    $folder = "mail/$user";

    if (!is_dir($folder)) {
        return array();
    }

    $emails = array();
    $files = scandir($folder, SCANDIR_SORT_DESCENDING); // Sort files in descending order
    foreach ($files as $file) {
        if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
            $email = file_get_contents("$folder/$file");

            // Remove "From: " prefix
            $email = preg_replace('/^From: /', '', $email);

            $emails[] = $email;
        }
    }

    return $emails;
}

// Retrieve the emails for the user
$emails = getEmails($emailAddress);

// Check if a message ID is provided
if (isset($_GET['messageId'])) {
    $messageId = $_GET['messageId'];

    // Retrieve the email content based on the message ID
    if (isset($emails[$messageId])) {
        $emailContent = $emails[$messageId];
    } else {
        // Invalid message ID, redirect back to mail.php
        header('Location: mail.php');
        exit;
    }
} else {
    // No message ID provided, redirect back to mail.php
    header('Location: mail.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="526x526" href="icon.png">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Email System - View Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .email-content {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .email-content img {
            max-width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>View Email</h2>
    <div class="email-content">
        <?php echo nl2br($emailContent); // Display the full email content ?>
    </div>
    <div class="actions">
        <a href="mail.php">Back to Inbox</a>
    </div>
</body>
</html>
