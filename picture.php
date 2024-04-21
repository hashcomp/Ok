<!DOCTYPE html>
<html>
<head>
    <title>Take Photo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>body {font-family: Arial;}</style>
</head>
<body>
    <h1>Take Photo</h1>
    <hr><br>
    <video id="video" width="100%" height="60%" autoplay playsinline></video><br>
    <button id="capture-btn">Take</button>

    <script>
        // Get access to the webcam
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
                video.play();
            })
            .catch(function(error) {
                console.log('Error accessing the webcam:', error);
            });

        // Capture button click event
        document.getElementById('capture-btn').addEventListener('click', function() {
            var video = document.getElementById('video');
            var canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw the video frame on canvas
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert canvas image to base64 data URL
            var dataURL = canvas.toDataURL();

            // Send the captured photo to the server
            $.ajax({
                type: 'POST',
                url: 'save_photo.php',
                data: { photo: dataURL },
                success: function(response) {
                    console.log('Photo saved successfully');
                },
                error: function(xhr, status, error) {
                    console.log('Error saving the photo:', error);
                }
            });
        });
    </script>
</body>
</html>