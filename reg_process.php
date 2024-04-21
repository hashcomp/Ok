<?php
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bio = $_POST['bio'];
    $interests = $_POST['interests'];
    $date = date('d-m-Y');

    // Check if username already exists
    $users_file = file_get_contents('users.txt');
    if (strpos($users_file, $username . '|') !== false) {
        die("Sorry, that username is taken. Please choose another one.");
    }

    // Create user account
    $users_file = fopen('users.txt', 'a');
    fwrite($users_file, "$username|$password\n");
    fclose($users_file);

    // Save user data to text file
    $user_data = "Username: $username\n";
    $user_data .= "Joined Date: $date\n";
    $user_data .= "Bio: $bio\n";
    $user_data .= "Interests: $interests\n";
    $user_data .= "Status: I have no status :(\n";
    $user_data .= "Age: Age has not been uploaded yet :(\n";
    $user_data .= "Favourite movie: $username doesn't have a favorite movie yet :(\n";
    $user_data .= "Favourite TV Show: $username doesn't have a favorite tv show yet :(\n";
    $user_data .= "Favourite Music: $username doesn't have favorite music yet :(\n";
    $ff = "adam\n";

    $user_txt_file = fopen("$username.txt", 'w');
    fwrite($user_txt_file, $user_data);
    fclose($user_txt_file);

    $friend = fopen("$username's.txt", 'w');
    fwrite($friend, $ff);
    fclose($friend);

    // Redirect to login page
    header('Location: log.php');
?>
