<?php
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];
    $attachmentPath = "mail/$emailAddress/$filename";
    $fileExtension = pathinfo($attachmentPath, PATHINFO_EXTENSION);
    $mimeTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ];

    if (file_exists($attachmentPath) && array_key_exists($fileExtension, $mimeTypes)) {
        $mimeType = $mimeTypes[$fileExtension];
        header("Content-Type: $mimeType");
        readfile($attachmentPath);
        exit;
    }
}
