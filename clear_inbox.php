<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}

$username = $_SESSION['username'];
$folder = "mail/$username";

// Function to clear the user's inbox
function clearInbox($folder) {
    if (is_dir($folder)) {
        $files = glob($folder . '/*.txt'); // Get all text files in the folder
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // Delete each file
            }
        }
    }
}

// Call the clearInbox function to delete all files in the user's folder
clearInbox($folder);

// Redirect the user back to the inbox page after clearing the inbox
header('Location: mail.php');
exit;
?>
a<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}

$username = $_SESSION['username'];
$folder = "mail/$username";

// Function to clear the user's inbox
function clearInbox($folder) {
    if (is_dir($folder)) {
        $files = glob($folder . '/*.txt'); // Get all text files in the folder
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // Delete each file
            }
        }
    }
}

// Call the clearInbox function to delete all files in the user's folder
clearInbox($folder);

// Redirect the user back to the inbox page after clearing the inbox
header('Location: mail.php');
exit;
?>
