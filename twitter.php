<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  padding-bottom: 50px; /* Add padding to accommodate the floating navbar */
}

.navbar {
  overflow: hidden;
  position: fixed;
  bottom: 0;
  background-color: black;
  width: 100%; /* Reduce the width of the navbar */
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2); /* Add a shadow effect */
  border-radius: 10px 10px 0 0; /* Round the top corners */
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 0;
  text-decoration: none;
  font-size: 17px;
  width: 33.33%; /* Set the width to one-third of the navbar */
  box-sizing: border-box; /* Include padding in the width calculation */
}

.navbar a:hover {
  background: #f1f1f1;
  color: black;
}

.navbar a.active {
  background-color: black;
  color: white;
}

.main {
  padding: 16px;
  margin-bottom: 30px;
}

iframe {
  width: 100%;
  height: calc(100vh - 50px); /* Subtract the height of the navbar */
  border: none;
  display: none; /* Hide all iframes by default */
}
</style>
</head>
<body onload="openTab('home')">

<div class="navbar">
  <a href="#home" class="active" onclick="openTab('home')">📨</a>
  <a href="#news" onclick="openTab('news')">📸</a>
  <a href="#contact" onclick="openTab('contact')">📖</a>
</div>

<iframe src="snap.php" id="home-frame"></iframe>
<iframe src="capture.php" id="news-frame"></iframe>
<iframe src="contacts.php" id="contact-frame"></iframe>

<script>
function openTab(tabName) {
  // Hide all iframes
  var iframes = document.getElementsByTagName("iframe");
  for (var i = 0; i < iframes.length; i++) {
    iframes[i].style.display = "none";
  }
  
  // Show the selected iframe
  document.getElementById(tabName + "-frame").style.display = "block";
  
  // Update active tab button
  var navLinks = document.getElementsByClassName("navbar")[0].getElementsByTagName("a");
  for (var i = 0; i < navLinks.length; i++) {
    navLinks[i].classList.remove("active");
  }
  document.querySelector('a[href="#' + tabName + '"]').classList.add("active");
}
</script>

</body>
</html>
