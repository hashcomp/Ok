<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>adam's whsprr profile</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="305x305" href="icon.png">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <?php
    // Read user profile data from the text file
    $username = isset($_GET['username']) ? $_GET['username'] : '';
    if (empty($username)) {
        die("No username specified.");
    }

    $profile_file = "$username.txt";

    if (!file_exists($profile_file)) {
        die("Profile not found.");
    }

    $profile_data = file_get_contents($profile_file);

    // Extract CSS code from profile data
    $pattern_css = "/<style>(.+)<\/style>/s";
    preg_match($pattern_css, $profile_data, $matches_css);
    $css_code = isset($matches_css[1]) ? $matches_css[1] : '';

    // Output the CSS code
    echo "<style>$css_code</style>";
    ?>
</head>
<body>
    <?php if (!isset($_GET['username'])) {
        die("No username specified.");
    }

    $username = $_GET['username'];

    // Read user profile data from the text file
    $profile_file = "$username.txt";

    if (!file_exists($profile_file)) {
        die("Profile not found.");
    }

    $profile_data = file_get_contents($profile_file);

    // Extract profile picture filename
    $pattern_picture = "/Profile Picture: (.+)/";
    preg_match($pattern_picture, $profile_data, $matches_picture);
    $profile_picture = isset($matches_picture[1]) ? $matches_picture[1] : '';

    // Remove profile picture line from profile data
    $profile_data = preg_replace($pattern_picture, '', $profile_data);

    // Extract username from profile data
    $pattern_username = "/Username: (.+)/";
    preg_match($pattern_username, $profile_data, $matches_username);
    $profile_username = isset($matches_username[1]) ? $matches_username[1] : '';

    // Remove username line from profile data
    $profile_data = preg_replace($pattern_username, '', $profile_data);

    // Extract bio from profile data
    $pattern_bio = "/Bio: (.+)/";
    preg_match($pattern_bio, $profile_data, $matches_bio);
    $profile_bio = isset($matches_bio[1]) ? $matches_bio[1] : '';

    // Remove bio line from profile data
    $profile_data = preg_replace($pattern_bio, '', $profile_data);

    // Extract interests from profile data
    $pattern_interests = "/Interests: (.+)/";
    preg_match($pattern_interests, $profile_data, $matches_interests);
    $profile_interests = isset($matches_interests[1]) ? $matches_interests[1] : '';

    // Remove interests line from profile data
    $profile_data = preg_replace($pattern_interests, '', $profile_data);

    // Extract favorite movie from profile data
    $pattern_movie = "/Favourite movie: (.+)/";
    preg_match($pattern_movie, $profile_data, $matches_movie);
    $favorite_movie = isset($matches_movie[1]) ? $matches_movie[1] : '';

    // Remove favorite movie line from profile data
    $profile_data = preg_replace($pattern_movie, '', $profile_data);

    // Extract favorite TV show from profile data
    $pattern_tvshow = "/Favourite TV Show: (.+)/";
    preg_match($pattern_tvshow, $profile_data, $matches_tvshow);
    $favorite_tvshow = isset($matches_tvshow[1]) ? $matches_tvshow[1] : '';

    $pattern_music = "/Favourite Music: (.+)/";
    preg_match($pattern_music, $profile_data, $matches_music);
    $favorite_music = isset($matches_music[1]) ? $matches_music[1] : '';
    $pattern_date = "/Joined Date: (.+)/";
    preg_match($pattern_date, $profile_data, $matches_date);
    $favorite_date = isset($matches_date[1]) ? $matches_date[1] : '';

    $pattern_age = "/Age: (.+)/";
    preg_match($pattern_age, $profile_data, $matches_age);
    $favorite_age = isset($matches_age[1]) ? $matches_age[1] : '';

    $pattern_status = "/Status: (.+)/";
    preg_match($pattern_status, $profile_data, $matches_status);
    $favorite_status = isset($matches_status[1]) ? $matches_status[1] : '';

    // Remove favorite TV show line from profile data
    $profile_data = preg_replace($pattern_tvshow, '', $profile_data);

    // Extract other information from profile data
    $other_info = trim($profile_data);

    // Extract image paths from profile data
    $pattern_images = "/<img src='([^']+)'[^>]*>/";
    preg_match_all($pattern_images, $profile_data, $matches_images);
    $profile_images = isset($matches_images[1]) ? $matches_images[1] : [];

    $star = '';
    if (in_array($username, ["adam", "Master Oogway", "Cyro", "cyro", "Donald J Trump", "friendnet"])) {
        $star = '<img style="height: 15px; width: 15px;" src="checkmark.png">'; // star symbol in HTML entity format
    }
    ?>

    <h1><?php echo $username, $star;?></h1>

    <?php if (!empty($profile_picture)) : ?>
        <img src="profile_pics/<?php echo $profile_picture ?>" alt="Profile Picture" style="max-width: 200px; margin-top: 20px;">
    <?php endif; ?>

    <b><p>Date Joined: <?php echo $favorite_date ?></p></b>

    <b><p>Age: <?php echo $favorite_age ?></p></b>

    <h3>Bio: <?php echo $profile_bio ?></h3>

    <h3>Status: <?php echo $favorite_status ?></h3>

    <table>
        <tr>
            <td><strong>Interests:</strong></td>
            <td><?php echo $profile_interests ?></td>
        </tr>
        <tr>
            <td><strong>Favourite Movie:</strong></td>
            <td><?php echo $favorite_movie ?></td>
        </tr>
        <tr>
            <td><strong>Favourite TV Show:</strong></td>
            <td><?php echo $favorite_tvshow ?></td>
        </tr>
        <tr>
            <td><strong>Favourite Music:</strong></td>
            <td><?php echo $favorite_music ?></td>
        </tr>
    </table>
    <br>
    <h4>Other Information:</h4>
    <p><?php echo $other_info ?></p>

    <h4>Images:</h4>
    <?php foreach ($profile_images as $image) : ?>
        <img src="<?php echo $image ?>" alt="Profile Image" style="max-width: 200px; margin-top: 20px;">
    <?php endforeach; ?>

    <br><br>
    <a href="index.html">Back to Home</a>
</body>
</html>
