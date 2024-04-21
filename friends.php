<?php
ini_set('display_errors', 0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}

if (!isset($_GET['username'])) {
    header('Location: index.php');
    exit;
}

$requested_username = $_GET['username'];
$filename = "$requested_username's.txt";

if (!file_exists($filename)) {
    $message = "$requested_username has no friends :(";
} else {
    $message = "$requested_username's friends:";
    $friend_list = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $friends = array();
    foreach ($friend_list as $friend) {
        $friend = trim($friend);
        if (!empty($friend)) {
            $friends[] = $friend;
        }
    }
    if (count($friends) == 0) {
        $message = "$requested_username has no friends :(";
    }
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
    <li><a href='<?php echo "view.php?username=$friend" ?>'><?php echo $friend ?></a></li>
    <?php } ?>
  </ul>
  <?php } ?>
</body>
</html>
