<?php
    session_start();
    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit;
    }
    $username = $_SESSION['username'];
    // Get form data
    $bio = $_POST['bio'];
    $status = $_POST['status'];
    $interests = $_POST['interests'];
    $favorite_movie = $_POST['favorite_movie'];
    $favorite_tv = $_POST['favorite_tv'];
    $favorite_music = $_POST['favorite_music'];
    $age = $_POST['age'];
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
    $text_file = preg_replace("/Bio: .*/", "Bio: $bio", $text_file);
    $text_file = preg_replace("/Interests: .*/", "Interests: $interests", $text_file);
    $text_file = preg_replace("/Status: .*/", "Status: $status", $text_file);
    $text_file = preg_replace("/Favourite movie: .*/", "Favourite movie: $favorite_movie", $text_file);
    $text_file = preg_replace("/Favourite TV Show: .*/", "Favourite TV Show: $favorite_tv", $text_file);
    $text_file = preg_replace("/Favourite Music: .*/", "Favourite Music: $favorite_music", $text_file);
    $text_file = preg_replace("/Age: .*/", "Age: $age", $text_file);
    // Save updated text file content
    file_put_contents("$username.txt", $text_file);
    // Redirect to profile page
    header("Location: profile.php?success=1");
    exit;
?>
