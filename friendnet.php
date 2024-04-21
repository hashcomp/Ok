<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}
?>
<html>
<meta name='apple-mobile-web-app-capable' content='yes' />
	<link rel='apple-touch-icon' sizes='305x305' href='icon.png'>
	<link rel='icon' href='favicon.ico' type='image/x-icon'/>
	<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/>
<style>body {font-family: Arial;}</style>
</html>
<?php
function getMutualFriends($username)
{
    $filename = "$username's.txt";

    if (!file_exists($filename)) {
        return array();
    }

    $friend_list = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $friends = array();

    foreach ($friend_list as $friend) {
        $friend = trim($friend);
        if (!empty($friend)) {
            $friends[] = $friend;
        }
    }

    return $friends;
}

function getSuggestedFriends($username)
{
    $suggested_friends = array();

    // Get the user's friends
    $user_friends = getMutualFriends($username);

    // Iterate through each friend
    foreach ($user_friends as $friend) {
        // Get the friend's friends
        $friend_friends = getMutualFriends($friend);

        // Iterate through each friend of friend
        foreach ($friend_friends as $friend_of_friend) {
            // Check if the friend of friend is not already a friend
            if (!in_array($friend_of_friend, $user_friends)) {
                // Check if the friend of friend is not already suggested
                if (!in_array($friend_of_friend, $suggested_friends)) {
                    // Add the friend of friend to the suggested friends list
                    $suggested_friends[] = $friend_of_friend;
                }
            }
        }
    }

    return $suggested_friends;
}

// Example usage:
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $suggested_friends = getSuggestedFriends($username);

    // Display the suggested friends
    if (count($suggested_friends) > 0) {
        echo "<h1>Friends of Friends:</h1>";
        echo "<ul>";
        foreach ($suggested_friends as $friend) {
            echo "<li><a href='view.php?username=$friend'>$friend:</a> <a href='add_friends2.php?username=$friend'>Add Friend :)</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<h1>No suggested friends found at the moment.</h1>";
    }
}
?>
