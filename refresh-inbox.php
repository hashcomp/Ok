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

// Get the currently viewed message ID, if any
$currentMessageId = isset($_SESSION['currentMessageId']) ? $_SESSION['currentMessageId'] : '';

// Generate the HTML content for the emails
$html = '';
foreach ($emails as $index => $email) {
    $lines = explode("\n", $email);
    $fromLine = $lines[0];
    $subjectLine = $lines[2];
    $emailId = 'email-' . $index;
    $html .= "<li onclick=\"toggleEmailContent('$emailId')\"><strong>$subjectLine</strong> - From: $fromLine</li>";
    $html .= "<div class=\"email-content" . ($currentMessageId === $emailId ? ' active' : '') . "\" id=\"$emailId\">";
    $html .= nl2br($email);
    $html .= "<div class=\"actions\">";
    $html .= "<div class='timestamp'>" . date('Y') . " the friend network.</div>";
    $html .= "<a href=\"send.php?address=$fromLine\">Reply</a>";
    $html .= "<a href=\"send.php?forward=" . urlencode($email) . "\">Forward</a>";
    $html .= "</div>";
    $html .= "</div>";
}

echo $html;
?>
