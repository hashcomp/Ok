<!DOCTYPE html>
<html>
<head>
  <title>File Sharing</title>
</head>
<body>
  <h1>File Sharing</h1>
  <p>Share files</p>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file upload
    $targetDirectory = 'file/';
    $fileName = basename($_FILES['file']['name']);
    $targetPath = $targetDirectory . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
      echo '<p>File uploaded successfully.</p>';
    } else {
      echo '<p>File upload failed.</p>';
    }
  }
  ?>

  <h2>Upload File</h2>
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <input type="submit" value="Upload">
  </form>

  <h2>Shared Files</h2>
  <ul>
    <?php
    $files = glob('file/*');
    foreach ($files as $file) {
      $fileName = basename($file);
      echo '<li><a href="' . $file . '">' . $fileName . '</a></li>';
    }
    ?>
  </ul>
</body>
</html>
