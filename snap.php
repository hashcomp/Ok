<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}
$name = $_SESSION['username'];

// Get the user's folder based on the session username
$folder = 'snap/' . $_SESSION['username'] . '@friendsnap/';

// Check if the user's folder exists
if (file_exists($folder)) {
    // Get all the image files in the user's folder
    $files = glob($folder . '*.jpg');

    // Sort the files in descending order by modification time
    usort($files, function ($a, $b) {
        return filemtime($b) - filemtime($a);
    });

    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<meta name="apple-mobile-web-app-capable" content="yes" />';
    echo '<link rel="apple-touch-icon" sizes="305x305" href="icon.png">';
    echo '<style>';
    echo 'body { background-color: white; font-family: Arial, sans-serif; color: black; }'; // Set the background color of the entire page to white and text color to black
    echo '.snap { background-color: white; border-radius: 10px; padding: 10px; margin-bottom: 10px; cursor: pointer; }'; // Applied styles to the .snap class
    echo '.snap .sender, .snap .actions a { color: black; }'; // Set the text color to black for the sender name and reply button
    echo '.snap .snap-image { display: none; border-radius: 10px; width: 100%; }'; // Hide the image initially and set the image styles
    echo '</style>';
    echo '</head>';
    echo '<body>';

    // Display each image with sender's username and a reply button
    $count = 0; // Initialize a counter to limit the number of displayed messages
    foreach ($files as $file) {
        $filename = basename($file);
        $senderName = substr($filename, 0, strpos($filename, '_'));

        echo '<div class="snap" onclick="toggleImage(this)">';
        echo '<div class="sender"><h2>' . $senderName . '</h2></div>';
        echo '<img class="snap-image" src="' . $file . '" alt="Snapchat Photo">';
        echo '<div class="actions">';
        echo '<a class="reply-btn" href="capture.php?sender=' . urlencode($senderName) . '">Reply</a>';
        echo '<hr>';
        echo '</div>';
        echo '</div>';

        $count++; // Increment the counter
        if ($count >= 7) {
            break; // Break the loop when the desired number of messages is reached
        }
    }

    echo '<script>';
    echo 'function toggleImage(element) {';
    echo '    var image = element.querySelector(".snap-image");';
    echo '    image.style.display = (image.style.display === "none") ? "block" : "none";';
    echo '}';
    echo '</script>';

    echo '</body>';
    echo '</html>';
} else {
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head>';
    echo '<style>';
    echo 'body { background-color: white; color: black; }'; // Set the background color of the entire page to white and text color to black
    echo '</style>';
    echo '</head>';
    echo '<body>';
    echo '<a href="snap.php">refresh</a>';
    echo '<div>No messages found.</div>';
    echo '</body>';
    echo '</html>';
}
?>
