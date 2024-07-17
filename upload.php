<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $videoTitle = $_POST['video-title'];
    $videoFile = $_FILES['video-file'];

    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($videoFile["name"]);

    // Move the uploaded file
    if (move_uploaded_file($videoFile["tmp_name"], $targetFile)) {
        echo "The video has been uploaded successfully.";
    } else {
        echo "Sorry, there was an error uploading your video.";
    }
}
?>
