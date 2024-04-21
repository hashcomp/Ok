<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the sender's name from the session and generate a unique filename
    $senderName = $_SESSION['username'] . '@friendsnap';
    $timestamp = time();
    $filename = $senderName . '_' . $timestamp . '.jpg';

    // Get the receiver's inbox from the form
    $receiverInbox = $_POST['receiverInbox'];

    // Define the path for the receiver's inbox folder
    $receiverInboxFolder = 'snap/' . $receiverInbox . '/';

    // Create the receiver's inbox folder if it doesn't exist
    if (!file_exists($receiverInboxFolder)) {
        mkdir($receiverInboxFolder, 0777, true);
    }

    // Get the captured photo data
    $photoData = $_POST['photoData'];

    // Remove the data URI scheme header
    $photoData = str_replace('data:image/jpeg;base64,', '', $photoData);

    // Decode the base64-encoded image data
    $decodedPhotoData = base64_decode($photoData);

    // Save the photo to the receiver's inbox folder
    file_put_contents($receiverInboxFolder . $filename, $decodedPhotoData);

    header('Location: capture.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Snapchat - Capture and Send</title>
    <script>
        window.onload = function() {
            // Get the value of the 'sender' parameter from the URL
            var sender = "<?php echo isset($_GET['sender']) ? $_GET['sender'] : ''; ?>";

            // Set the value of the receiver's inbox text area
            document.getElementById('receiverInbox').value = sender;
        };

        function capturePhoto() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');

            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const photoData = canvas.toDataURL('image/jpeg');
            document.getElementById('photoData').value = photoData;
            document.getElementById('captureForm').submit();
        }
    </script>
</head>
<body>
  <style>body {font-family: Arial;}</style>
    <h1>Send pic</h1>
    <form id="captureForm" method="POST" action="">
        <label for="receiverInbox">Receiver's address:</label>
        <input type="text" name="receiverInbox" id="receiverInbox" required><br><br>
        <button type="button" onclick="capturePhoto();">Take Photo</button>
        <br><br>
        <video id="video" width="100%" height="60%" autoplay playsinline>
        <br><br>
        <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
        <br><br>
        <input type="hidden" id="photoData" name="photoData" value="">
        <button type="submit" style="display: none;">Send</button>
    </form>

    <script>
        const video = document.getElementById('video');

        // Check if the user's browser supports media devices and getUserMedia
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.log('Unable to access the camera: ' + error);
                });
        } else {
            console.log('Media devices not supported');
        }
    </script>
</body>
</html>
