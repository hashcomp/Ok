<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}
$username = $_SESSION['username'];
$emailAddress = $username . '@friendnet';

// Function to retrieve the list of sent emails for a user
function getSentEmails($user) {
    $folder = "sent/$user";
    if (!is_dir($folder)) {
        return array();
    }

    $sentEmails = array();
    $files = scandir($folder, SCANDIR_SORT_DESCENDING); // Sort files in descending order
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $email = file_get_contents("$folder/$file");
            $sentEmails[] = $email;
        }
    }

    return $sentEmails;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>friendnet.</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon" sizes="526x526" href="icon.png">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .email-list {
            list-style-type: none;
            padding: 0;
        }
        .email-list li {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        .email-content {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
        }
    </style>
    <script>
        function toggleEmailContent(emailId) {
            var emailContent = document.getElementById(emailId);
            if (emailContent.style.display === "none") {
                emailContent.style.display = "block";
            } else {
                emailContent.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <h2>Sent Mail</h2>
    <a href="mail.php">back</a>
    <ul class="email-list">
        <?php
        $sentEmails = getSentEmails($emailAddress);
        $sentEmails = array_reverse($sentEmails); // Reverse the order of sentEmails array

        foreach ($sentEmails as $index => $email) {
            $lines = explode("\n", $email);
            $toLine = $lines[1];
            $subjectLine = $lines[2];
            $emailId = 'sent-email-' . $index;
            echo "<li onclick=\"toggleEmailContent('$emailId')\"><strong>$subjectLine</strong> - $toLine</li>";
            echo "<div class=\"email-content\" id=\"$emailId\">";
            echo nl2br($email); // Display the full email content
            echo "</div>";
        }
        ?>
    </ul>
</body>
</html>
