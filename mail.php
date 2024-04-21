<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}
$username = $_SESSION['username'];
$emailAddress = $username . '@friendnet';

// Function to retrieve the list of emails for a user
function getEmails($user, $searchTerm = '') {
    $folder = "mail/$user";

    // Create the user's folder if it doesn't exist
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true); // Create the folder with write permissions
        $welcomeEmailContent = "adam@friendnet\n\nSubject: Welcome\n\nWelcome to friendnet, a place to make friends.";
        file_put_contents("$folder/150000.txt", $welcomeEmailContent); // Create a welcome email file
    }

    if (!is_dir($folder)) {
        return array();
    }

    $emails = array();
    $files = scandir($folder, SCANDIR_SORT_DESCENDING); // Sort files in descending order
    foreach ($files as $file) {
        if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
            $emailContent = file_get_contents("$folder/$file");

            // Extract the sent date from the file name
           // Extract the sent date from the file name
            $sentDate = date('Y-m-d H:i:s', (int) pathinfo($file, PATHINFO_FILENAME));
            $sentDate = date('Y-m-d H:i:s', strtotime($sentDate . '+1 hour'));


            // Remove "From: " prefix
            $emailContent = preg_replace('/^From: /', '', $emailContent);

            // If search term is provided, check if it exists in email content or subject line
            if (!empty($searchTerm)) {
                $lines = explode("\n", $emailContent);
                $subjectLine = $lines[2];
                if (stripos($emailContent, $searchTerm) === false && stripos($subjectLine, $searchTerm) === false) {
                    continue; // Skip the email if search term not found
                }
            }

            $emails[] = [
                'content' => $emailContent,
                'sentDate' => $sentDate
            ];
        }
    }

    return $emails;
}

// Get the search term from the query parameter
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Retrieve the emails based on the search term
$emails = getEmails($emailAddress, $searchTerm);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="526x526" href="icon.png">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Email System - Inbox</title>
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
            cursor: pointer;
        }
        .email-list li:hover {
            background-color: #f5f5f5;
        }
        .email-content {
            display: none;
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .actions {
            margin-top: 10px;
        }
        .actions a {
            margin-right: 10px;
        }
        .timestamp {
            font-size: 0.8em;
            color: #999;
        }
        .email-content img {
            max-width: 100%;
            margin-top: 10px;
        }
        .search-form {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function toggleEmailContent(emailId) {
            var content = document.getElementById(emailId);
            content.style.display = (content.style.display === 'none') ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <h2>Inbox</h2>
    Your Address: <?php echo $emailAddress; ?><br>
    <div class="search-form">
        <form method="GET" action="mail.php">
            <input type="text" name="search" placeholder="Search..." value="<?php echo $searchTerm; ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="actions">
        <a href="send.php">Send mail</a>
        <a href="mail.php">Refresh</a>
    </div>
    <ul class="email-list">
        <?php
        foreach ($emails as $index => $email) {
            $lines = explode("\n", $email['content']);
            $fromLine = $lines[0];
            $subjectLine = isset($lines[2]) ? $lines[2] : '';
            $emailId = 'email-' . $index;
            $sentDate = $email['sentDate'];
            echo "<li onclick=\"toggleEmailContent('$emailId')\"><strong>$subjectLine</strong> - From: $fromLine <span class='timestamp'>$sentDate</span></li>";
            echo "<div class=\"email-content\" id=\"$emailId\">";
            echo nl2br($email['content']); // Display the full email content
            
            // Extract image path from the email content and display the image
            $matches = array();
            preg_match_all('/<img src="([^"]+)"/', $email['content'], $matches);
            if (!empty($matches[1])) {
                // Display the images if any
            }

            echo "<div class=\"actions\">";
            echo "<div class='timestamp'>Sent: " . $email['sentDate'] . "</div>"; // Display sent date
            echo "<a href=\"send.php?address=$fromLine\">Reply</a>";
            echo "<a href=\"send.php?forward=" . urlencode($email['content']) . "\">Forward</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </ul>
</body>
</html>