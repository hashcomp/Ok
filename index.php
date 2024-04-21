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
	<title>friendnet</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon" sizes="526x526" href="icon.png">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <style type="text/css">
        html {
            overflow: auto;
        }
          
        html,
        body,
        div,
        iframe {
            margin: 0px;
            padding: 0px;
            height: 100%;
            border: none;
        }
          
        iframe {
            display: block;
            width: 100%;
            border: none;
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
</head>
  
<body>
    <iframe src="menu.php"
            frameborder="0" 
            marginheight="0" 
            marginwidth="0" 
            width="100%" 
            height="100%" 
            scrolling="auto">
  </iframe>
  
</body>
  
</html>
