<?php
    session_start();
    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit;
    }
    $username = $_SESSION['username'];
    // Get form data
    $CSS = $_POST['CSS'];
    $friend_links = '';
    if (!empty($_POST['friends'])) {
        $friend_list = explode(',', $_POST['friends']);
        foreach ($friend_list as $friend) {
            $friend = trim($friend);
            if (!empty($friend)) {
                $friend_links .= "$friend, ";
            }
        }
        $friend_links = rtrim($friend_links, ', ');
    }
    // Get current text file content
    $text_file = file_get_contents("$username.txt");
    // Update text file content
    $text_file = preg_replace("/CSS: .*/", "CSS: $CSS", $text_file);
    // Save updated text file content
    file_put_contents("$username.txt", $text_file);
    // Redirect to profile page
    header("Location: test.php?success=1");
    exit;
?>
