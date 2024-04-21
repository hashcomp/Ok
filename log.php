<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>whsprr</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="apple-touch-icon" sizes="305x305" href="icon.png">
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
}
.sidenav {
  width: 130px;
  position: fixed;
  z-index: 1;
  top: 60px;
  right: 10px;
  background: #868786;
  overflow-x: hidden;
  padding: 8px 0;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: gray;
  display: block;
}

.sidenav a:hover {
  color: #FFD73B;
}

.main {
  margin-left: 140px; /* Same width as the sidebar + left position in px */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-image: url("https://www.fonewalls.com/wp-content/uploads/Columbia-Purple-Gradient-Wallpaper.jpg"); /* set your preferred image URL */
  background-size: cover; /* or "contain" to adjust the image size */
}


li {
  float: left;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  font-size: 25px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #FFD73B;
}
body {font-family: Arial;}

.recessed-image {
  box-shadow: 5px 5px 10px #888888;
  display: inline-block;
}
.top {
  background-image: url('IMG_7408.JPG');  
  background-repeat: no-repeat;  
  background-attachment: fixed;    
  background-size: cover;
  height: 75;
}
.bottom {
  height: 50%;
}
/* Style the tab */
.tab {
  width: 97%
  border: none
  overflow: hidden;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
  width: 20%;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  height: 70vh;
  padding: 2px 5px;
  display: none;
  border-top: none;
  border: none
}
  </style>
</head>
<body>

<ul>
  <div style="display: flex; justify-content: center; align-items: center;">
  <a href="index.php"><img width="207.25" height="63.4" src="logo.png" alt="friendnet."></a>
  </div>
</ul><br>
  <br>
	<h1>Please Login :)</h1>
	<?php
		// Check for login error
		if (isset($_GET['error'])) {
			echo "<p style='color: red;'>Invalid username or password.</p>";
		}
	?>
	<form action="log_process.php" method="post">
		<label>Username:</label>
		<input type="text" name="username"><br><br>
		<label>Password:</label>
		<input type="password" name="password"><br><br>
		<input type="submit" value="Login">
    <a href="reg.php">Don't have an account?</a><br><br>
	</form>
</body>
<footer><center><font size="-1">2023 friendnet, a adam, jude and cyro project</font></center><br><center><font size="-1">friendnet 1.2, made in Dover 🗣️🔥</font></center></footer>
</html>
