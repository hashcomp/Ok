<!DOCTYPE html>
<html>
  <head>
    <title>search</title>
    <style>body {font-family: Arial;}</style>
  </head>
  <body>
    <h1>Find users or friends</h1>
    <hr>
    <form>
      <label for="page">Enter User's Page Name:</label>
      <input type="text" id="page" name="page">
      <input type="submit" value="Open">
    </form>

    <script>
      const form = document.querySelector('form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();
        const pageName = document.getElementById('page').value;
        window.location.href = `view.php?username=${pageName}`;
      });
    </script>
  </body>
</html>
