<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}


$requested_username = $_SESSION['username'];
$filename = "$requested_username's.txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $friend_to_delete = $_POST['friend'];
        if (file_exists($filename)) {
            $friend_list = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $updated_friend_list = array_diff($friend_list, [$friend_to_delete]);
            
            // Add a new line at the bottom of the file
            $updated_friend_list[] = "";
            
            file_put_contents($filename, implode(PHP_EOL, $updated_friend_list));
        }
    } elseif (isset($_POST['delete_friend_list'])) {
        if (file_exists($filename)) {
            unlink($filename);
            header('Location: index.php');
            exit;
        }
    }
}

$message = "$requested_username's friends:";
$friends = [];
if (file_exists($filename)) {
    $friend_list = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $friends = array_filter($friend_list, function ($friend) {
        return !empty(trim($friend));
    });
}

?>

<html>
<head>
    <style>body {font-family: Arial;}</style>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='apple-mobile-web-app-capable' content='yes' />
    <link rel='apple-touch-icon' sizes='305x305' href='icon.png'>
    <link rel='icon' href='favicon.ico' type='image/x-icon'/>
    <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/>
</head>
<body>
    <h1><?php echo $message ?></h1>
    <?php if (count($friends) > 0) { ?>
        <ul>
            <?php foreach ($friends as $friend) { ?>
                <li>
                    <form method="POST" action="">
                        <input type="hidden" name="friend" value="<?php echo $friend; ?>">
                        <?php echo $friend; ?>
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</body>
</html>
