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
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
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
  background-image: url("https://www.fonewalls.com/wp-content/uploads/Columbia-Purple-Gradient-Wallpaper.jpg");
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

.recessed-image {
  box-shadow: 5px 5px 10px #888888;
  display: inline-block;
}
.top {
  background-image: url('https://images.rawpixel.com/image_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvdjQxMi1rdWwtMDEtZmx1aWRzaGFwZV8yLmpwZw.jpg');  
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
    body {
      font-family: Arial, sans-serif;
      background-color: #ffffffff;
      color: #fff;
      margin: 0;
      padding: 0;
    }

    #container {
      text-align: left;
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
    }

    #links-container {
      text-align: left;
    }

    .link {
      display: block;
      padding: 5px;
      margin-bottom: 5px;
      text-decoration: none;
      color: inherit;
    }

    h1 {
      font-weight: bold;
      color: black;
      font-size: 40px;
    }
    .padding {
      padding: 0px 20px;
    }
    .link:hover {
      text-decoration: underline;
    }

    #current-time {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 12px;
      color: black;
    }
  </style>

  <script>
    function changeBackground(color) {
      document.body.style.backgroundColor = color;
      document.body.style.color = getContrastColor(color);
      localStorage.setItem('background', color);
    }

    function getContrastColor(color) {
      var hexColor = color.replace('#', '');
      var r = parseInt(hexColor.substr(0, 2), 16);
      var g = parseInt(hexColor.substr(2, 2), 16);
      var b = parseInt(hexColor.substr(4, 2), 16);
      var yiq = (r * 299 + g * 587 + b * 114) / 1000;
      return yiq >= 128 ? '#FFFFFFFF' : '#fff';
    }

    document.addEventListener('DOMContentLoaded', function () {
      const storedBackground = localStorage.getItem('background');
      if (storedBackground) {
        document.body.style.backgroundColor = storedBackground;
        document.body.style.color = getContrastColor(storedBackground);
      }
    });

    function updateCurrentTime() {
      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();
      var formattedTime =
        ('0' + hours).slice(-2) +
        ':' +
        ('0' + minutes).slice(-2) +
        ':' +
        ('0' + seconds).slice(-2);
      document.getElementById('current-time').textContent = formattedTime;
    }

    setInterval(updateCurrentTime, 1000);
  </script>
</head>
<body>
  <ul>
  <div style="display: flex;">
 <a href="index.php"><img width="207.25" height="63.4" src="logo.png" alt="friendnet." class="padding"></a>
  </div>
  </ul>
  <div id="links-container">
    <h1><a class="link" href="stat.php" onclick="changeBackground('#FFFFFFFF')">status 🗿</a></h1>
    <h1><a class="link" href="viewprofile.php" onclick="changeBackground('#FFFFFFFF')">profile 😊</a></h1>
    <h1><a class="link" href="sendmail.php" onclick="changeBackground('#FFFFFFFF')">mail 📬</a></h1>
    <h1><a class="link" href="editprofile.php" onclick="changeBackground('#FFFFFFFF')">edit profile ✏️</a></h1>
    <h1><a class="link" href="urfriend.php" onclick="changeBackground('#FFFFFFFF')">your friendnet 💾</a></h1>
    <h1><a class="link" href="feed.php" onclick="changeBackground('#FFFFFFFF')">mutual friends 🎉</a></h1>
    <h1><a class="link" href="open.php" onclick="changeBackground('#FFFFFFFF')">find 🔍</a></h1>
     <h1><a class="link" href="editprofile.php" onclick="changeBackground('#FFFFFFFF')">edit profile ✏️</a></h1>
    <h1><a class="link" href="custom.php" onclick="changeBackground('#FFFFFFFF')">pimp ur profile 🎨</a></h1>
    <h1><a class="link" href="addnew_profilepic.php" onclick="changeBackground('#FFFFFFFF')">new profile pic 🖼</a></h1>
    <h1><a class="link" href="logout.php" onclick="changeBackground('#FFFFFFFF')">logout 👋</a></h1>
  </div>
  <span id="current-time"></span>
</body>
</html>