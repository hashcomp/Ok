<?php
  session_start();
	if (!isset($_SESSION['username'])) {
		header('Location: log.php');
		exit;
	}
	$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>whsprr</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="apple-touch-icon" sizes="305x305" href="icon.png">
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <title>whsprr</title>
  <style>
    body {
      margin: 0;
      padding: 0;
    }
    
    #top-bar {
      background-color: white;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
    }
    
    #logo {
      width: 40px;
      height: 40px;
    }
    
    #menu-button {
      padding: 10px;
      background-color: white;
    }
    
    #refresh-button {
      padding: 10px;
      background-color: white;
    }
    
    #content {
      width: 100%;
      height: calc(100vh - 50px);
      border: none;
    }
  </style>
</head>
<body>
  <div id="top-bar">
    <a href="index.php"><img width="207.25" height="63.4" src="logo.png" alt="friendnet."></a>
    <a href="menu.php">&#9776;</a>
    <a href="urfriend.php">&#8635;</a>
  </div>
  <iframe id="content" src="fr.php"></iframe>
</body>
</html>
